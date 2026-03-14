<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Article;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
// Utilisation de la Façade Cloudinary
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class AdminController extends Controller
{
    public function dashboard()
    {
        $count_articles = Article::count();
        $unread_messages = Contact::where('is_read', false)->count();
        $messages = Contact::latest()->take(5)->get();
        $categories = Category::all();
        $articles = Article::latest()->get();

        return view('admin.dashboard', compact('count_articles', 'unread_messages', 'messages', 'categories', 'articles'));
    }

    public function showMessage($id)
    {
        $message = Contact::findOrFail($id);
        $message->update(['is_read' => true]);
        $categories = Category::all();
        
        return view('admin.show_message', compact('message', 'categories'));
    }

    public function editQsn()
    {
        $qsn = Setting::where('key', 'qsn_content')->first();
        $categories = Category::all();
        
        return view('admin.edit_qsn', compact('qsn', 'categories'));
    }

    public function updateQsn(Request $request)
    {
        Setting::where('key', 'qsn_content')->update([
            'value' => $request->value
        ]);
        return back()->with('success', 'Page QSN mise à jour !');
    }

    public function createArticle()
    {
        $categories = Category::all();
        return view('admin.create_article', compact('categories'));
    }

    public function storeArticle(Request $request)
{
    $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
        'category_id' => 'required|exists:categories,id',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
    ]);

    try {
        // CONFIGURATION MANUELLE DIRECTE
        $config = new \Cloudinary\Configuration\Configuration([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ]
        ]);

        $uploadApi = new \Cloudinary\Api\Upload\UploadApi($config);
        
        // Upload direct
        $result = $uploadApi->upload($request->file('image')->getRealPath(), [
            'folder' => 'actupress_articles'
        ]);

        $imageUrl = $result['secure_url']; // On récupère l'URL ici

    } catch (\Exception $e) {
        return back()->withInput()->withErrors(['image' => 'Erreur Cloudinary : ' . $e->getMessage()]);
    }

    // --- CRÉATION DE L'ARTICLE ---
    $slug = \Illuminate\Support\Str::slug($request->title);
    $count = 1;
    while (\App\Models\Article::where('slug', $slug)->exists()) {
        $slug = \Illuminate\Support\Str::slug($request->title) . '-' . $count;
        $count++;
    }

    if ($request->has('is_headline')) {
        \App\Models\Article::where('is_headline', true)->update(['is_headline' => false]);
    }

    \App\Models\Article::create([
        'title' => $request->title,
        'slug' => $slug,
        'content' => $request->content,
        'category_id' => $request->category_id,
        'image' => $imageUrl,
        'is_headline' => $request->has('is_headline'),
    ]);

    return redirect()->route('admin.dashboard')->with('success', 'Article publié avec succès !');
}
    public function editArticle($id)
    {
        $article = Article::findOrFail($id);
        $categories = Category::all();
        return view('admin.edit_article', compact('article', 'categories'));
    }

    public function updateArticle(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $data = $request->only(['title', 'content', 'category_id']);

        if ($request->hasFile('image')) {
            try {
                $result = Cloudinary::upload($request->file('image')->getRealPath(), [
                    'folder' => 'actupress_articles'
                ]);
                $data['image'] = $result->getSecurePath();
                
                // Optionnel : Supprimer l'ancienne image sur Cloudinary ici pour ne pas encombrer ton compte
            } catch (\Exception $e) {
                return back()->withInput()->withErrors(['image' => 'Erreur upload : ' . $e->getMessage()]);
            }
        }

        $data['is_headline'] = $request->has('is_headline');
        if ($data['is_headline']) {
            Article::where('is_headline', true)->where('id', '!=', $id)->update(['is_headline' => false]);
        }

        if ($request->title !== $article->title) {
            $slug = Str::slug($request->title);
            $count = 1;
            while (Article::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug = Str::slug($request->title).'-'.$count;
                $count++;
            }
            $data['slug'] = $slug;
        }

        $article->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Article modifié avec succès !');
    }

    public function deleteArticle($id)
    {
        $article = Article::findOrFail($id);

        // Suppression sur Cloudinary
        if ($article->image && str_contains($article->image, 'cloudinary.com')) {
            try {
                // On extrait le public_id correctement (ex: actupress_articles/nom_du_fichier)
                $path = parse_url($article->image, PHP_URL_PATH);
                $segments = explode('/', $path);
                $filename = end($segments);
                $publicId = pathinfo($filename, PATHINFO_FILENAME);
                
                Cloudinary::destroy('actupress_articles/' . $publicId);
            } catch (\Exception $e) {
                // Log l'erreur si besoin, mais on continue pour supprimer l'article de la DB
            }
        } 
        // Suppression locale (ancienne méthode)
        elseif ($article->image && !str_starts_with($article->image, 'http')) {
            Storage::disk('public')->delete(str_replace('storage/', '', $article->image));
        }
    
        $article->delete();
        return back()->with('success', 'Article supprimé avec succès.');
    }
}