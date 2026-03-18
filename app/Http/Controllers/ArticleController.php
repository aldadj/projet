<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Affiche la page d'accueil avec tous les articles.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categories = Category::all();

        // Base de la requête pour les likes
        $query = Article::withCount('likes')
            ->withExists(['likes as is_liked' => function($q) { 
                $q->where('user_id', Auth::id()); 
            }]);

        if ($search) {
            $articles = $query->where('title', 'LIKE', "%{$search}%")
                              ->orWhere('content', 'LIKE', "%{$search}%")
                              ->latest()
                              ->get();
            $headlines = collect();
        } else {
            // Slider (Top 5)
            $headlines = (clone $query)->latest()->take(5)->get();
            
            // Grille (Tous les articles)
            $articles = $query->latest()->get(); 
        }

        return view('welcome', compact('headlines', 'articles', 'categories'));
    }

    /**
     * Affiche un article détaillé via son slug.
     */
    public function show($slug)
    {
        $article = Article::withCount('likes')
                    ->withExists(['likes as is_liked' => function($q) { 
                        $q->where('user_id', Auth::id()); 
                    }])
                    ->where('slug', $slug)->firstOrFail();

        $similaires = Article::where('category_id', $article->category_id)
                            ->where('id', '!=', $article->id)
                            ->take(3)
                            ->get();

        $categories = Category::all();
        return view('article', compact('article', 'similaires', 'categories'));
    }

    /**
     * Filtre les articles par catégorie (Sans pagination).
     */
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        
        $articles = $category->articles()
            ->withCount('likes')
            ->withExists(['likes as is_liked' => function($q) { 
                $q->where('user_id', Auth::id()); 
            }])
            ->latest()
            ->get(); // On récupère tout sans pagination

        $categories = Category::all();
        return view('category', compact('category', 'articles', 'categories'));
    }
}