<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggle($id)
    {
        $article = Article::findOrFail($id);
        $user = Auth::user();

        // Vérifier si le like existe déjà
        $like = $article->likes()->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete();
            $isLiked = false;
        } else {
            $article->likes()->create(['user_id' => $user->id]);
            $isLiked = true;
        }

        // Retourne le nouveau statut et le compteur mis à jour (format JSON pour AJAX)
        return response()->json([
            'liked' => $isLiked,
            'count' => $article->likes()->count()
        ]);
    }
}
