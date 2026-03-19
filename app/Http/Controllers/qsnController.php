<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QsnController extends Controller
{
    public function view_qsn()
    {
        // Utilise firstOrNew pour éviter l'erreur si la base est vide
        $qsn = \App\Models\Setting::firstOrNew(['key' => 'qsn_content']);

        // Texte par défaut pour éviter une page vide
        if (!$qsn->value) {
            $qsn->value = "Le contenu de la page Qui Sommes-Nous est en cours de rédaction.";
        }

        $categories = \App\Models\Category::all();
        return view('qsn', compact('qsn', 'categories'));
    }
}
