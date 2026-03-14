@extends('layouts.app')

@section('content')
@php
    $categoryColors = [
        'sport' => 'bg-red-600',
        'politique' => 'bg-blue-800',
        'technologie' => 'bg-green-600',
        'culture' => 'bg-purple-600',
        'economie' => 'bg-yellow-600',
    ];
@endphp

<div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <div>
        <h1 class="text-3xl font-bold text-white uppercase border-b-4 border-blue-500 inline-block pb-2">
            {{ $category->name }}
        </h1>
        <p class="text-gray-400 mt-2">Les derniers articles de la section {{ $category->name }}.</p>
    </div>
    <a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition inline-flex items-center gap-2">
        &larr; Retour à l'accueil
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @forelse($articles as $article)
        <a href="{{ route('article.show', $article->slug) }}" class="group relative block w-full h-64 rounded-2xl overflow-hidden shadow-xl">
            {{-- Image avec vérification Cloudinary (http) ou Local (storage) --}}
            <img src="{{ str_starts_with($article->image, 'http') ? $article->image : asset(str_replace('storage/', '', $article->image)) }}" 
                 class="w-full h-full object-cover" onerror="this.src='{{ asset('images/default.jpg') }}'">
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent opacity-90"></div>

            <div class="absolute bottom-0 left-0 w-full p-4 text-white">
                <span class="inline-block {{ $categoryColors[$article->category->slug] ?? 'bg-gray-600' }} text-white text-[10px] font-bold px-2 py-1 rounded-full uppercase mb-2 shadow-sm">
                    {{ $article->category->name }}
                </span>

                <h3 class="text-lg font-bold mb-1 leading-tight group-hover:text-red-400 transition-colors line-clamp-2">
                    {{ $article->title }}
                </h3>

                <div class="flex items-center text-xs text-gray-400 font-medium">
                    {{ $article->created_at->format('d/m/Y') }}
                </div>
            </div>
        </a>
    @empty
        <div class="col-span-3 py-10 text-center text-gray-400 italic">
            Aucun article pour le moment dans cette catégorie.
        </div>
    @endforelse
</div>

<div class="mt-10">
    {{ $articles->links() }}
</div>
@endsection