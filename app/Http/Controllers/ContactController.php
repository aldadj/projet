<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function view_contact()
    {
        $categories = \App\Models\Category::all();
        return view('contact', compact('categories'));
    }

    public function store_contact(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'subject' => 'required|string|max:255',
        'message' => 'required',
    ]);
    Contact::create($validated);
    return back()->with('success', 'Votre message a bien été envoyé !');
    }
}
