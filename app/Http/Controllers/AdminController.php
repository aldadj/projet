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
        // On récupère les chiffres pour les cartes
        $count_articles = Article::count();
        $unread_messages = Contact::where('is_read', false)->count();
        
        // On récupère les listes pour les tables
        $messages = Contact::latest()->take(5)->get();
        $articles = Article::latest()->get();

        // On récupère les catégories pour le menu (si utilisé dans layouts.app)
        $categories = Category::all();
        
        return view('admin.dashboard', compact('count_articles', 'unread_messages', 'messages', 'categories', 'articles'));
    }

    public function showMessage($id)
    {
        $message = Contact::findOrFail($id);
        $message->is_read = true;
        $message->save();
        
        $categories = Category::all();
        return view('admin.show_message', compact('message', 'categories'));
    }

    public function editQsn()
    {
        // Utilise firstOrNew pour éviter l'erreur 500 si la ligne n'existe pas encore
        $qsn = Setting::firstOrNew(['key' => 'qsn_content']);
        $categories = Category::all();
        
        return view('admin.edit_qsn', compact('qsn', 'categories'));
    }

    public function updateQsn(Request $request)
    {
        // UpdateOrCreate permet de créer la ligne si elle n'existe pas
        Setting::updateOrCreate(
            ['key' => 'qsn_content'],
            ['value' => $request->value]
        );
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
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
    ]);

    $imageUrl = null;

    try {
        $config = new \Cloudinary\Configuration\Configuration([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ]
        ]);

        $uploadApi = new \Cloudinary\Api\Upload\UploadApi($config);
        
        // Upload direct seulement si une image est présente
        if ($request->hasFile('image')) {
            $result = $uploadApi->upload($request->file('image')->getRealPath(), [
                'folder' => 'actupress_articles'
            ]);
            $imageUrl = $result['secure_url'];
        }

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $data = $request->only(['title', 'content', 'category_id']);

        // Gère la suppression de l'image si la case est cochée
        if ($request->has('delete_image') && $article->image) {
            if (str_contains($article->image, 'cloudinary.com')) {
                try {
                    $path = parse_url($article->image, PHP_URL_PATH);
                    $segments = explode('/', $path);
                    $filename = end($segments);
                    $publicId = pathinfo($filename, PATHINFO_FILENAME);
                    Cloudinary::destroy('actupress_articles/' . $publicId);
                } catch (\Exception $e) {
                    // On peut logger l'erreur si besoin, mais on continue
                }
            }
            $data['image'] = null;
        } 
        // Gère le remplacement de l'image si un nouveau fichier est uploadé
        elseif ($request->hasFile('image')) {
            // Supprime l'ancienne image avant d'uploader la nouvelle
            if ($article->image && str_contains($article->image, 'cloudinary.com')) {
                try {
                    $path = parse_url($article->image, PHP_URL_PATH);
                    $segments = explode('/', $path);
                    $filename = end($segments);
                    $publicId = pathinfo($filename, PATHINFO_FILENAME);
                    Cloudinary::destroy('actupress_articles/' . $publicId);
                } catch (\Exception $e) {
                    // On peut logger l'erreur si besoin
                }
            }
            // Upload de la nouvelle image
            $result = Cloudinary::upload($request->file('image')->getRealPath(), ['folder' => 'actupress_articles']);
            $data['image'] = $result->getSecurePath();
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

    public function deleteMessage($id)
    {
        $message = Contact::findOrFail($id);
        $message->delete();
        return back()->with('success', 'Message supprimé avec succès.');
    }
}