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
    <div class="grid grid-cols-12 gap-6"> 
        
        {{-- BLOC GAUCHE : SLIDER DE LA "UNE" --}}
        <div class="col-span-12 lg:col-span-8 flex flex-col gap-6">
            {{-- Le Slider - Hauteur h-80 --}}
            <div class="h-80 overflow-hidden relative group bg-[#212121] border-b-4 border-[#bb1919]">
                <div id="headline-slider" data-total="{{ $headlines->count() }}" class="flex h-full transition-transform duration-700 ease-in-out">
                    @foreach($headlines as $headline)
                        <a href="{{ route('article.show', $headline->slug) }}" class="min-w-full h-full relative block">
                            @if($headline->image)
                                <img src="{{ str_starts_with($headline->image, 'http') ? $headline->image : asset('storage/' . $headline->image) }}"
                                     class="w-full h-full object-cover opacity-80 group-hover:scale-105 transition-transform duration-[2s]">
                                <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent"></div>
                                
                                <div class="absolute bottom-0 left-0 w-full p-6 text-white">
                                    <span class="inline-block {{ $categoryColors[$headline->category->slug] ?? 'bg-gray-600' }} text-[9px] font-black px-2 py-1 uppercase tracking-widest mb-3">
                                        {{ $headline->category->name }}
                                    </span>
                                    <h2 class="text-3xl font-black mb-1 leading-none tracking-tighter uppercase">
                                        {{ $headline->title }}
                                    </h2>
                                    <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">
                                        {{ $headline->created_at->format('d M Y') }}
                                    </div>
                                </div>
                            @else
                                <div class="w-full h-full p-8 flex flex-col justify-center bg-gray-900 border border-gray-100/10">
                                    <span class="inline-block {{ $categoryColors[$headline->category->slug] ?? 'bg-gray-600' }} text-[9px] font-black px-2 py-1 uppercase mb-4 self-start">
                                        {{ $headline->category->name }}
                                    </span>
                                    <h2 class="text-4xl font-black mb-4 leading-none text-white uppercase tracking-tighter hover:text-[#bb1919] transition-colors">
                                        {{ $headline->title }}
                                    </h2>
                                    <p class="text-gray-400 text-sm line-clamp-3 mb-4 max-w-2xl font-medium leading-relaxed italic">
                                        {{ Str::limit($headline->content, 180) }}
                                    </p>
                                    <span class="text-[#bb1919] text-[10px] font-black uppercase tracking-[0.2em]">Lire l'article &rarr;</span>
                                </div>
                            @endif
                        </a>
                    @endforeach
                </div>

                {{-- Contrôles Slider (Opacité group-hover) --}}
                <button id="prev-slide" class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-[#bb1919] text-white p-2 opacity-0 group-hover:opacity-100 transition-all z-20">←</button>
                <button id="next-slide" class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-[#bb1919] text-white p-2 opacity-0 group-hover:opacity-100 transition-all z-20">→</button>

                {{-- Dots du Slider --}}
                <div class="absolute bottom-4 right-4 flex space-x-2 z-10">
                    @foreach($headlines as $index => $h)
                        <div class="slider-dot w-1.5 h-1.5 rounded-full transition-colors {{ $index === 0 ? 'bg-[#bb1919]' : 'bg-gray-500' }}"></div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- BLOC HAUT DROITE : 2 ARTICLES VERTICAUX (h-1/2) --}}
        <div class="col-span-12 lg:col-span-4 flex flex-col gap-4 h-auto lg:h-80">
            @foreach($articles->take(2) as $f_article)
                <a href="{{ route('article.show', $f_article->slug) }}" class="group relative block w-full h-64 lg:h-1/2 overflow-hidden bg-[#212121] border border-gray-100">
                    @if($f_article->image)
                        <img src="{{ str_starts_with($f_article->image, 'http') ? $f_article->image : asset('storage/' . $f_article->image) }}"
                             class="w-full h-full object-cover opacity-70 transition-transform duration-700 group-hover:scale-110 grayscale group-hover:grayscale-0">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-90"></div>
                        <div class="absolute bottom-0 left-0 w-full p-4 text-white">
                            <span class="inline-block {{ $categoryColors[$f_article->category->slug] ?? 'bg-gray-600' }} text-[8px] font-black px-2 py-0.5 uppercase mb-2">
                                {{ $f_article->category->name }}
                            </span>
                            <h3 class="text-lg font-black leading-none group-hover:text-[#bb1919] transition-colors line-clamp-2 uppercase tracking-tighter">
                                {{ $f_article->title }}
                            </h3>
                        </div>
                    @else
                        {{-- Cas sans image pour les articles de droite --}}
                        <div class="p-5 h-full flex flex-col bg-white">
                            <span class="inline-block {{ $categoryColors[$f_article->category->slug] ?? 'bg-gray-600' }} text-[8px] font-black px-2 py-0.5 uppercase mb-2 self-start">
                                {{ $f_article->category->name }}
                            </span>
                            <h3 class="text-lg font-black leading-tight group-hover:text-[#bb1919] transition-colors line-clamp-2 text-gray-900 uppercase">
                                {{ $f_article->title }}
                            </h3>
                            <p class="text-gray-500 text-[10px] line-clamp-2 mt-2 font-medium leading-relaxed">
                                {{ Str::limit($f_article->content, 80) }}
                            </p>
                        </div>
                    @endif
                </a>
            @endforeach
        </div>

        {{-- GRILLE PRINCIPALE (8 COL) --}}
        <div class="col-span-12 lg:col-span-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($articles->skip(2)->take(4) as $article)
                <article class="group border-b border-gray-100 pb-6 flex flex-col">
                    @if($article->image)
                        <a href="{{ route('article.show', $article->slug) }}" class="h-48 overflow-hidden block mb-4 relative">
                            <img src="{{ str_starts_with($article->image, 'http') ? $article->image : asset('storage/' . $article->image) }}" 
                                 class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-105">
                        </a>
                    @endif
                    
                    <div class="flex flex-col flex-grow">
                        <span class="text-[9px] font-black uppercase tracking-[0.2em] {{ str_replace('bg-', 'text-', explode(' ', $categoryColors[$article->category->slug] ?? 'bg-gray-600')[0]) }} mb-2">
                            {{ $article->category->name }}
                        </span>
                        
                        <h3 class="text-xl font-black mb-3 leading-tight group-hover:underline decoration-2 underline-offset-4 text-gray-900 uppercase tracking-tighter">
                            <a href="{{ route('article.show', $article->slug) }}">{{ $article->title }}</a>
                        </h3>

                        {{-- Le petit texte descriptif en bas (remis comme avant) --}}
                        <p class="text-gray-500 text-sm font-medium leading-relaxed line-clamp-2 mb-4">
                            {{ Str::limit($article->content, 110) }}
                        </p>

                        {{-- Footer Card --}}
                        <div class="flex items-center gap-4 mt-auto pt-4 border-t border-gray-50">
                            <button onclick="toggleLike(this, {{ $article->id }})" class="flex items-center gap-1 text-gray-400 hover:text-[#bb1919] transition">
                                <span class="text-[10px] font-black likes-count">{{ $article->likes_count }}</span> ❤️
                            </button>
                            <span class="text-[9px] text-gray-300 font-black uppercase ml-auto">
                                {{ $article->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        {{-- SECTION EN DIRECT (4 COL) --}}
        <div class="col-span-12 lg:col-span-4 bg-[#fcfcfc] border border-gray-100 p-6 h-[550px] flex flex-col relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-[#bb1919]"></div>
            <h2 class="font-black text-xs uppercase tracking-[0.3em] mb-6 text-gray-900 flex items-center gap-3">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-red-600"></span>
                </span>
                Fil Info Direct
            </h2>
            
            <div class="space-y-6 overflow-y-auto pr-2 custom-scrollbar flex-grow">
                @foreach($articles->take(12) as $flash)
                    <a href="{{ route('article.show', $flash->slug) }}" class="block group border-b border-gray-50 pb-4 hover:border-[#bb1919] transition-all">
                        <span class="text-[#bb1919] text-[9px] font-black tracking-widest">{{ $flash->created_at->format('H:i') }}</span>
                        <p class="text-gray-800 group-hover:text-[#bb1919] transition-colors mt-1 font-bold text-xs leading-snug italic uppercase tracking-tight">
                            {{ $flash->title }}
                        </p>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
    /* Scrollbar minimaliste pour le direct */
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #333; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.getElementById('headline-slider');
        if (!slider) return;

        const dots = document.querySelectorAll('.slider-dot');
        const prevBtn = document.getElementById('prev-slide');
        const nextBtn = document.getElementById('next-slide');
        const totalSlides = parseInt(slider.dataset.total || "0", 10);
        
        if (totalSlides <= 1) return;
        
        let currentIndex = 0;
        let slideInterval;

        const updateUI = () => {
            slider.style.transform = `translateX(-${currentIndex * 100}%)`;
            dots.forEach((dot, index) => {
                dot.classList.toggle('bg-[#bb1919]', index === currentIndex);
                dot.classList.toggle('bg-gray-500', index !== currentIndex);
            });
        };

        const nextSlide = () => {
            currentIndex = (currentIndex + 1) % totalSlides;
            updateUI();
        };

        const prevSlide = () => {
            currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
            updateUI();
        };

        const startAutoSlide = () => {
            // AJUSTÉ ICI : 3000ms = 3 secondes
            slideInterval = setInterval(nextSlide, 3000);
        };

        const resetAutoSlide = () => {
            clearInterval(slideInterval);
            startAutoSlide();
        };

        // Événements boutons
        if (nextBtn) {
            nextBtn.addEventListener('click', () => { nextSlide(); resetAutoSlide(); });
        }
        if (prevBtn) {
            prevBtn.addEventListener('click', () => { prevSlide(); resetAutoSlide(); });
        }

        startAutoSlide();
    });
</script>
@endsection