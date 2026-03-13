<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        // On récupère les stats
        $count_articles = Article::count();
        $unread_messages = Contact::where('is_read', false)->count();
        $messages = Contact::latest()->take(5)->get();
        $categories = Category::all();
        $articles = Article::latest()->get();

        // Ajoute de categories dans le compact
        return view('admin.dashboard', compact('count_articles', 'unread_messages', 'messages', 'categories', 'articles'));
    }

    //méthode pour lire un message
    public function showMessage($id)
    {
        $message = Contact::findOrFail($id);
        $message->update(['is_read' => true]); // On marque comme lu
        $categories = Category::all();
        
        return view('admin.show_message', compact('message', 'categories'));
    }

    //pour pouvoir modifier le texte de qsn cote admin
    public function editQsn()
    {
        $qsn = \App\Models\Setting::where('key', 'qsn_content')->first();
        $categories = Category::all();
        
        return view('admin.edit_qsn', compact('qsn', 'categories'));
    }

    public function updateQsn(Request $request)
    {
        \App\Models\Setting::where('key', 'qsn_content')->update([
            'value' => $request->value
        ]);
        return back()->with('success', 'Page QSN mise à jour !');
    }

 
    //une pour afficher le formulaire de création et une pour enregistrer l'article.
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // Augmenté à 5MB
        ]);

        // Gestion de l'image
        try {
            $result = $request->file('image')->storeOnCloudinary('actupress_articles');
            $imageUrl = $result->getSecurePath();
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['image' => 'Erreur Cloudinary : ' . $e->getMessage()]);
        }

        // Si on coche "A la une", on décoche l'ancien article à la une
        if ($request->has('is_headline')) {
            Article::where('is_headline', true)->update(['is_headline' => false]);
        }

        // Création d'un slug unique pour éviter les conflits
        $slug = Str::slug($request->title);
        $count = 1;
        while (Article::where('slug', $slug)->exists()) {
            $slug = Str::slug($request->title) . '-' . $count;
            $count++;
        }

        Article::create([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'image' => $imageUrl, // On stocke l'URL complète de Cloudinary
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

        // Gestion de l'image si une nouvelle est fournie
        if ($request->hasFile('image')) {
            try {
                $result = $request->file('image')->storeOnCloudinary('actupress_articles');
                $data['image'] = $result->getSecurePath();
            } catch (\Exception $e) {
                return back()->withInput()->withErrors(['image' => 'Erreur upload : ' . $e->getMessage()]);
            }
        }

        // Si on coche "A la une", on décoche l'ancien article à la une
        $data['is_headline'] = $request->has('is_headline');
        if ($data['is_headline']) {
            Article::where('is_headline', true)->where('id', '!=', $id)->update(['is_headline' => false]);
        }

        // Mise à jour du slug si le titre change
        if ($request->title !== $article->title) {
            $slug = Str::slug($request->title);
            $count = 1;
            while (Article::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug = Str::slug($request->title) . '-' . $count;
                $count++;
            }
            $data['slug'] = $slug;
        }

        $article->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Article modifié avec succès !');
    }

    // Suppression d'un article
    public function deleteArticle($id)
    {
        $article = Article::findOrFail($id);

        if ($article->image) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $article->image));
        }

        $article->delete();
        return back()->with('success', 'Article supprimé avec succès.');
    }
}