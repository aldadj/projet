<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class qsnController extends Controller
{
    public function view_qsn()
    {
        $qsn = \App\Models\Setting::where('key', 'qsn_content')->first();
        $categories = \App\Models\Category::all();
        return view('qsn', compact('qsn', 'categories'));
    }
}
