<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // On récupère les catégories pour le menu
        $categories = Category::all();

        // Si l'utilisateur fait une recherche
        if ($search) {
            $articles = Article::where('title', 'LIKE', "%{$search}%")
                                ->orWhere('content', 'LIKE', "%{$search}%")
                                ->latest()
                                ->get();
            
            // On renvoie une vue spécifique pour les résultats
            return view('search', compact('articles', 'search', 'categories'));
        }

        // Sinon, affichage normal de l'accueil
        // Récupérer les 5 derniers articles pour le slider "À la une"
        $headlines = Article::latest()->take(5)->get();
        // Récupérer le reste des articles pour la grille (en sautant les 5 premiers)
        $articles = Article::latest()->skip(5)->take(999)->get();

        return view('welcome', compact('headlines', 'articles', 'categories'));
    }
    public function show($slug)
    {
        // On cherche l'article par son slug
        $article = Article::where('slug', $slug)->firstOrFail();

        // On récupère 3 articles de la même catégorie pour le bas du dessin
        $similaires = Article::where('category_id', $article->category_id)
                            ->where('id', '!=', $article->id)
                            ->take(3)
                            ->get();

        // On récupère toujours les catégories pour le menu
        $categories = Category::all();

        return view('article', compact('article', 'similaires', 'categories'));
    }

//une méthode qui filtre les articles en fonction de la catégorie sélectionnée.
    public function category($slug)
    {
        // On trouve la catégorie par son slug
        $category = Category::where('slug', $slug)->firstOrFail();
        
        // On récupère tous les articles de cette catégorie, triés par les plus récents
        $articles = $category->articles()->latest()->paginate(6); // Afficher 6 articles par page comme demandé
        
        // On récupère toujours les catégories pour le menu
        $categories = Category::all();

        return view('category', compact('category', 'articles', 'categories'));
    }
}
