@extends('layouts.app')

@section('content')
@php
    $categoryColors = [
        'sport' => 'bg-[#ffd230] text-black',
        'politique' => 'bg-[#bb1919] text-white',
        'technologie' => 'bg-[#1380a1] text-white',
        'culture' => 'bg-[#a00062] text-white',
        'economie' => 'bg-[#e4a42d] text-white',
    ];
@endphp

<div class="max-w-7xl mx-auto px-4 py-8">
    {{-- SECTION HAUTE : SLIDER + 2 ARTICLES + FIL INFO + 4 ARTICLES --}}
    <div class="grid grid-cols-12 gap-6"> 
        
        {{-- GAUCHE : SLIDER --}}
        <div class="col-span-12 lg:col-span-8 flex flex-col gap-6">
            <div class="h-80 overflow-hidden relative group bg-[#212121] border-b-4 border-[#bb1919]">
                <div id="headline-slider" data-total="{{ $headlines->count() }}" class="flex h-full transition-transform duration-700 ease-in-out">
                    @foreach($headlines as $headline)
                        <a href="{{ route('article.show', $headline->slug) }}" class="min-w-full h-full relative block">
                            @if($headline->image)
                                <img src="{{ str_starts_with($headline->image, 'http') ? $headline->image : asset('storage/' . $headline->image) }}"
                                     class="w-full h-full object-cover opacity-80 group-hover:scale-105 transition-transform duration-[2s]">
                                <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
                                <div class="absolute bottom-0 left-0 w-full p-6 text-white">
                                    <span class="inline-block {{ $categoryColors[$headline->category->slug] ?? 'bg-gray-600' }} text-[9px] font-black px-2 py-1 uppercase mb-3">
                                        {{ $headline->category->name }}
                                    </span>
                                    <h2 class="text-3xl font-black mb-1 leading-none uppercase">{{ $headline->title }}</h2>
                                </div>
                            @endif
                        </a>
                    @endforeach
                </div>
                <button id="prev-slide" class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/50 text-white p-2 z-20">←</button>
                <button id="next-slide" class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/50 text-white p-2 z-20">→</button>
            </div>

            {{-- LES 4 ARTICLES (2 LIGNES DE 2) SOUS LE SLIDER --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-4">
                @foreach($articles->skip(2)->take(4) as $article)
                    @include('partials.article-card', ['article' => $article, 'categoryColors' => $categoryColors])
                @endforeach
            </div>
        </div>

        {{-- DROITE : 2 ARTICLES + FIL INFO --}}
        <div class="col-span-12 lg:col-span-4 flex flex-col gap-6">
            {{-- Les 2 articles en haut à droite --}}
            <div class="flex flex-col gap-4">
                @foreach($articles->take(2) as $f_article)
                    <a href="{{ route('article.show', $f_article->slug) }}" class="group relative block w-full h-40 overflow-hidden bg-[#212121] border border-gray-100">
                        @if($f_article->image)
                            <img src="{{ str_starts_with($f_article->image, 'http') ? $f_article->image : asset('storage/' . $f_article->image) }}" class="w-full h-full object-cover opacity-70 grayscale group-hover:grayscale-0 transition-all">
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
                            <div class="absolute bottom-0 p-4 text-white">
                                <h3 class="text-md font-black leading-tight uppercase line-clamp-2">{{ $f_article->title }}</h3>
                            </div>
                        @endif
                    </a>
                @endforeach
            </div>

            {{-- FIL INFO DIRECT --}}
            <div class="bg-[#fcfcfc] border border-gray-100 p-6 h-96 flex flex-col relative shadow-sm">
                <div class="absolute top-0 left-0 w-full h-1 bg-[#bb1919]"></div>
                <h2 class="font-black text-xs uppercase tracking-[0.3em] mb-6 flex items-center gap-3">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-red-600"></span>
                    </span>
                    Fil Info Direct
                </h2>
                <div class="space-y-6 overflow-y-auto custom-scrollbar flex-grow">
                    @foreach($articles->take(10) as $flash)
                        <a href="{{ route('article.show', $flash->slug) }}" class="block group border-b border-gray-50 pb-4">
                            <span class="text-[#bb1919] text-[9px] font-black">{{ $flash->created_at->format('H:i') }}</span>
                            <p class="text-gray-800 group-hover:text-[#bb1919] mt-1 font-bold text-xs uppercase italic">{{ $flash->title }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- SECTION BASSE : TOUT LE RESTE EN 3 COLONNES --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12">
        @foreach($articles->skip(6) as $article)
            @include('partials.article-card', ['article' => $article, 'categoryColors' => $categoryColors])
        @endforeach
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #333; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.getElementById('headline-slider');
        if (!slider) return;
        const totalSlides = parseInt(slider.dataset.total || "0", 10);
        let currentIndex = 0;
        const updateUI = () => { slider.style.transform = `translateX(-${currentIndex * 100}%)`; };
        document.getElementById('next-slide').addEventListener('click', () => { currentIndex = (currentIndex + 1) % totalSlides; updateUI(); });
        document.getElementById('prev-slide').addEventListener('click', () => { currentIndex = (currentIndex - 1 + totalSlides) % totalSlides; updateUI(); });
        setInterval(() => { currentIndex = (currentIndex + 1) % totalSlides; updateUI(); }, 5000);
    });
</script>
@endsection