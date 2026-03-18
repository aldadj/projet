@extends('layouts.app')

@section('content')
@php
    // Couleurs BBC par catégorie
    $categoryColors = [
        'sport' => 'bg-[#ffd230] text-black', // Le jaune sport typique
        'politique' => 'bg-[#bb1919] text-white',
        'technologie' => 'bg-[#1380a1] text-white',
        'culture' => 'bg-[#a00062] text-white',
        'economie' => 'bg-[#e4a42d] text-white',
    ];
    $catStyle = $categoryColors[$category->slug] ?? 'bg-[#bb1919] text-white';
@endphp

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-[#f6f6f6] min-h-screen py-6">
    
    {{-- BARRE DE TITRE SECTION (Style BBC) --}}
    <div class="flex items-center gap-0 mb-8">
        <div class="{{ $catStyle }} px-4 py-2 text-2xl font-bold uppercase tracking-tighter">
            {{ $category->name }}
        </div>
        <div class="flex-grow h-[2px] bg-gray-300"></div>
    </div>

    {{-- GRILLE PRINCIPALE --}}
    <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
        
        @forelse($articles as $index => $article)
            @if($index === 0)
                {{-- ARTICLE À LA UNE (Prend plus de place) --}}
                <div class="md:col-span-8 group">
                    <a href="{{ route('article.show', $article->slug) }}" class="block overflow-hidden">
                        @if($article->image)
                            <div class="relative aspect-video mb-4 overflow-hidden">
                                <img src="{{ str_starts_with($article->image, 'http') ? $article->image : asset('storage/' . $article->image) }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                {{-- Icône Vidéo ou Live si nécessaire --}}
                            </div>
                        @endif
                        <h2 class="text-3xl md:text-5xl font-bold text-[#212121] leading-tight hover:underline decoration-[#bb1919] decoration-4 underline-offset-4 mb-4">
                            {{ $article->title }}
                        </h2>
                    </a>
                    <p class="text-gray-600 text-lg leading-relaxed mb-4 line-clamp-3">
                        {{ $article->content }}
                    </p>
                    <div class="flex items-center gap-4 text-sm font-medium text-gray-400">
                        <span class="flex items-center gap-1 border-r border-gray-300 pr-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 6v6l4 2" stroke-width="2" stroke-linecap="round"/></svg>
                            {{ $article->created_at->diffForHumans() }}
                        </span>
                        <span class="uppercase tracking-widest text-[#bb1919] font-black">{{ $category->name }}</span>
                    </div>
                </div>
            @else
                {{-- ARTICLES SECONDAIRES (Colonnes de droite ou ligne suivante) --}}
                <div class="md:col-span-4 border-b md:border-b-0 md:border-l border-gray-200 md:pl-6 pb-6 group">
                    <a href="{{ route('article.show', $article->slug) }}">
                        @if($article->image)
                            <div class="aspect-video mb-3 overflow-hidden">
                                <img src="{{ str_starts_with($article->image, 'http') ? $article->image : asset('storage/' . $article->image) }}" 
                                     class="w-full h-full object-cover group-hover:brightness-90 transition-all">
                            </div>
                        @endif
                        <h3 class="text-xl font-bold text-[#212121] leading-snug group-hover:text-[#bb1919] transition-colors">
                            {{ $article->title }}
                        </h3>
                    </a>
                    <div class="mt-3 flex items-center gap-2 text-xs text-gray-400 font-bold uppercase tracking-tighter">
                        <span class="w-2 h-2 rounded-full bg-gray-300"></span>
                        {{ $article->created_at->format('d M Y') }}
                    </div>
                </div>
            @endif
        @empty
            <div class="col-span-12 py-20 text-center text-gray-400 uppercase font-black tracking-widest">
                Aucune actualité disponible.
            </div>
        @endforelse

    </div>

    {{-- PAGINATION BBC STYLE --}}
    <div class="mt-16 pt-8 border-t-4 border-black flex justify-between items-center">
        <div class="text-sm font-black uppercase tracking-tighter">Page {{ $articles->currentPage() }} sur {{ $articles->lastPage() }}</div>
        <div class="flex gap-1">
            {{ $articles->links() }}
        </div>
    </div>
</div>

<style>
    /* Simulation de la police BBC Reith */
    body {
        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        background-color: #f6f6f6;
    }
    
    /* Customization de la pagination Laravel pour coller au style */
    .pagination nav { display: flex; gap: 2px; }
    .pagination span, .pagination a { 
        padding: 8px 16px; 
        background: black; 
        color: white; 
        font-weight: 900;
        text-transform: uppercase;
        font-size: 12px;
    }
    .pagination .active span { background: #bb1919; }
</style>
@endsection