@extends('layouts.app')

@section('content')
@php
    $categoryColors = [
        'sport' => 'border-[#ffd230] text-[#ffd230]',
        'politique' => 'border-[#bb1919] text-[#bb1919]',
        'technologie' => 'border-[#1380a1] text-[#1380a1]',
        'culture' => 'border-[#a00062] text-[#a00062]',
        'economie' => 'border-[#e4a42d] text-[#e4a42d]',
    ];
    $accentBorder = explode(' ', $categoryColors[$article->category->slug] ?? 'border-[#bb1919] text-[#bb1919]')[0];
    $accentText = explode(' ', $categoryColors[$article->category->slug] ?? 'border-[#bb1919] text-[#bb1919]')[1];
@endphp

<div class="max-w-7xl mx-auto bg-white shadow-sm border-x border-gray-100 min-h-screen">
    
    {{-- Fil d'Ariane --}}
    <nav class="px-6 py-4 border-b border-gray-100 flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">
        <a href="{{ route('home') }}" class="hover:text-[#bb1919] transition-colors">Accueil</a>
        <span class="text-gray-200">/</span>
        <a href="{{ route('category.show', $article->category->slug) }}" class="{{ $accentText }}">{{ $article->category->name }}</a>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-0">
        
        {{-- COLONNE PRINCIPALE --}}
        <div class="lg:col-span-8 p-6 md:p-12 border-r border-gray-100">
            
            <header class="mb-10">
                {{-- Badge Catégorie --}}
                <span class="inline-block py-1 px-3 bg-[#212121] text-white text-[9px] font-black uppercase tracking-[0.3em] mb-6">
                    Édition {{ $article->category->name }}
                </span>

                <h1 class="text-4xl md:text-6xl font-black text-[#212121] leading-[0.95] tracking-tighter mb-8">
                    {{ $article->title }}
                </h1>
                
                <div class="flex items-center justify-between py-6 border-y border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-[#212121] flex items-center justify-center text-white font-black text-xl">
                            {{ substr($article->category->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-[#212121]">Par la Rédaction ActuPress</p>
                            <p class="text-[11px] text-gray-400 font-bold uppercase tracking-tighter mt-1">
                                Publié le {{ $article->created_at->format('d F Y') }}
                            </p>
                        </div>
                    </div>
                    
                    {{-- Bouton Partage Rapide --}}
                    <div class="hidden md:flex gap-2">
                        <button onclick="shareArticle()" class="w-10 h-10 border border-gray-100 flex items-center justify-center hover:bg-[#212121] hover:text-white transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" stroke-width="2.5"/></svg>
                        </button>
                    </div>
                </div>
            </header>

            {{-- Image Principale avec cadre --}}
            @if($article->image)
                <figure class="mb-12 relative">
                    <div class="absolute inset-0 bg-gray-100 -z-10 translate-x-2 translate-y-2"></div>
                    <img src="{{ str_starts_with($article->image, 'http') ? $article->image : asset('storage/' . $article->image) }}"
                         class="w-full object-cover max-h-[550px] border border-gray-200" alt="{{ $article->title }}">
                    <figcaption class="mt-4 text-[10px] text-gray-400 font-black uppercase tracking-[0.2em] flex items-center gap-3">
                        <span class="w-10 h-[1px] bg-gray-200"></span>
                        Doc. ActuPress / Ouagadougou Bureau
                    </figcaption>
                </figure>
            @endif

            {{-- Corps de l'article avec Lettrine --}}
            <div class="article-content">
                <div class="text-[#333] leading-[1.8] font-serif text-xl md:text-2xl space-y-8 first-letter:text-7xl first-letter:font-black first-letter:text-[#212121] first-letter:mr-3 first-letter:float-left">
                    {!! nl2br(e($article->content)) !!}
                </div>
            </div>

            {{-- Interactions --}}
            <div class="mt-16 pt-10 border-t-4 border-[#212121] flex flex-wrap items-center gap-6">
                <button onclick="toggleLike(this, {{ $article->id }})" 
                        class="flex items-center gap-3 px-8 py-4 bg-[#212121] text-white font-black text-[10px] uppercase tracking-[0.2em] hover:bg-[#bb1919] transition-all transform active:scale-95">
                    <span>❤️</span> Recommander (<span class="likes-count">{{ $article->likes_count }}</span>)
                </button>
            </div>
        </div>

        {{-- SIDEBAR --}}
        <aside class="lg:col-span-4 p-8 bg-[#f9f9f9]">
            <div class="sticky top-24">
                <h3 class="text-[11px] font-black uppercase tracking-[0.3em] text-[#212121] mb-10 flex items-center justify-between">
                    Articles Similaires
                    <span class="w-12 h-1 bg-[#bb1919]"></span>
                </h3>

                <div class="space-y-12">
                    @foreach($similaires as $item)
                        <article class="group relative">
                            <a href="{{ route('article.show', $item->slug) }}" class="block">
                                @if($item->image)
                                    <div class="aspect-video overflow-hidden mb-4 grayscale group-hover:grayscale-0 transition-all duration-700">
                                        <img src="{{ str_starts_with($item->image, 'http') ? $item->image : asset('storage/' . $item->image) }}"
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                                    </div>
                                @endif
                                <h4 class="text-xl font-black text-[#212121] leading-tight group-hover:text-[#bb1919] transition-colors">
                                    {{ $item->title }}
                                </h4>
                                <p class="mt-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                                    {{ $item->category->name }} — {{ $item->created_at->format('d.m.y') }}
                                </p>
                            </a>
                        </article>
                    @endforeach
                </div>

                {{-- Newsletter Card --}}
                <div class="mt-16 p-8 bg-[#212121] text-white relative overflow-hidden">
                    <span class="absolute -right-4 -top-4 text-white opacity-5 text-7xl font-black italic">NEWS</span>
                    <h5 class="text-2xl font-black uppercase tracking-tighter mb-4 relative z-10">Restez informé.</h5>
                    <p class="text-[11px] text-gray-400 font-medium leading-relaxed mb-6 relative z-10 uppercase tracking-widest">L'essentiel de l'actualité directement dans votre boîte mail.</p>
                    <button class="w-full py-4 bg-white text-black font-black uppercase text-[10px] tracking-[0.2em] hover:bg-[#bb1919] hover:text-white transition-all relative z-10">
                        S'abonner maintenant
                    </button>
                </div>
            </div>
        </aside>

    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Lora:ital,wght@0,400;0,700;1,400&display=swap');

    .font-serif {
        font-family: 'Lora', Georgia, serif;
    }
    
    .article-content p {
        margin-bottom: 2rem;
    }

    /* Animation fluide pour les images */
    img {
        transition: filter 0.5s ease-in-out;
    }
</style>
@endsection