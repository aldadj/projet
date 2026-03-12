<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cat1 = Category::first();

    // Article "A LA UNE" (ton grand bloc sur le dessin)
    Article::create([
        'title' => 'Bienvenue sur notre nouveau site de presse',
        'slug' => Str::slug('Bienvenue sur notre nouveau site de presse'),
        'content' => 'Ceci est le contenu de l\'article principal...',
        'image' => 'https://via.placeholder.com/800x400', // Image temporaire
        'is_headline' => true,
        'category_id' => $cat1->id,
    ]);

    // Quelques articles normaux pour la grille
    for ($i = 1; $i <= 6; $i++) {
        Article::create([
            'title' => "Article d'actualité numéro $i",
            'slug' => Str::slug("Article d'actualité numéro $i"),
            'content' => "Contenu détaillé de l'article $i...",
            'image' => 'https://via.placeholder.com/400x300',
            'is_headline' => false,
            'category_id' => $cat1->id,
        ]);
    }
    }
}
