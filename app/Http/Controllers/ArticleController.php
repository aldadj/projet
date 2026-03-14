<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Affiche la page d'accueil avec recherche et sections.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categories = Category::all();

        if ($search) {
            $articles = Article::where('title', 'LIKE', "%{$search}%")
                                ->orWhere('content', 'LIKE', "%{$search}%")
                                ->latest()
                                ->get();
            
            return view('search', compact('articles', 'search', 'categories'));
        }

        // Récupérer les 5 derniers articles pour le slider "À la une"
        $headlines = Article::latest()->take(5)->get();
        // Récupérer le reste des articles pour la grille (en sautant les 5 premiers)
        $articles = Article::latest()->skip(5)->take(999)->get();

        return view('welcome', compact('headlines', 'articles', 'categories'));
    }

    /**
     * Affiche un article détaillé via son slug.
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        $similaires = Article::where('category_id', $article->category_id)
                            ->where('id', '!=', $article->id)
                            ->take(3)
                            ->get();

        $categories = Category::all();

        return view('article', compact('article', 'similaires', 'categories'));
    }

    /**
     * Filtre les articles par catégorie.
     */
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $articles = $category->articles()->latest()->paginate(6); 
        $categories = Category::all();

        return view('category', compact('category', 'articles', 'categories'));
    }

    /**
     * Enregistre un nouvel article (Upload vers Cloudinary).
     */
   
}