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

<div class="grid grid-cols-2 md:grid-cols-3 gap-6">
    @forelse($articles as $article)
        <a href="{{ route('article.show', $article->slug) }}" class="group bg-gray-800/70 hover:bg-gray-800 transition-colors rounded-2xl shadow-lg overflow-hidden flex flex-col border border-gray-700/50 hover:border-blue-500/50">
            @if($article->image)
                <div class="h-48 overflow-hidden">
                    <img src="{{ str_starts_with($article->image, 'http') ? $article->image : asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                </div>
            @endif
            <div class="p-4 flex flex-col flex-grow">
                {{-- La catégorie est déjà connue sur cette page, on peut l'omettre pour alléger --}}
                <h3 class="text-md font-bold mb-2 leading-tight group-hover:text-blue-400 transition-colors line-clamp-3 flex-grow text-gray-100">
                    {{ $article->title }}
                </h3>

                @if(!$article->image)
                    <p class="text-gray-400 text-sm line-clamp-4 mb-3">
                        {{ $article->content }}
                    </p>
                    <span class="text-blue-400 text-xs font-bold uppercase hover:underline mt-auto">Voir plus &rarr;</span>
                @endif

                <div class="flex items-center text-xs text-gray-400 font-medium mt-auto pt-2">
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