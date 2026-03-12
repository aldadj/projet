@extends('layouts.app')

@section('content')
<style>
    body { background-color: #0f172a !important; color: #e2e8f0; }
</style>

@php
    $categoryColors = [
        'sport' => 'bg-red-600',
        'politique' => 'bg-blue-800',
        'technologie' => 'bg-green-600',
        'culture' => 'bg-purple-600',
        'economie' => 'bg-yellow-600',
    ];
@endphp

<div class="grid grid-cols-12 gap-6">
    
    {{-- On ajoute data-total ici pour que le JS puisse le lire sans erreur --}}
    <div class="col-span-12 lg:col-span-8 flex flex-col gap-6">
        <div class="h-80 overflow-hidden rounded-2xl shadow-xl relative group">
            <div id="headline-slider" data-total="{{ $headlines->count() }}" class="flex h-full transition-transform duration-700 ease-in-out">
                @foreach($headlines as $headline)
                    <a href="{{ route('article.show', $headline->slug) }}" class="min-w-full h-full relative block">
                        <img src="{{ asset($headline->image) }}" class="w-full h-full object-cover">
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent opacity-90"></div>

                        <div class="absolute bottom-0 left-0 w-full p-4 text-white">
                            <span class="inline-block {{ $categoryColors[$headline->category->slug] ?? 'bg-gray-600' }} text-white text-[10px] font-bold px-2 py-1 rounded-full uppercase mb-2 shadow-sm">
                                {{ $headline->category->name }}
                            </span>

                            <h2 class="text-2xl font-bold mb-1 leading-tight hover:text-red-400 transition-colors">
                                {{ $headline->title }}
                            </h2>

                            <div class="flex items-center text-xs text-gray-400 font-medium">
                                {{ $headline->created_at->format('d/m/Y') }}
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- Flèches de navigation --}}
            <button id="prev-slide" class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white p-2 rounded-full opacity-0 group-hover:opacity-100 transition-opacity z-20 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </button>
            <button id="next-slide" class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white p-2 rounded-full opacity-0 group-hover:opacity-100 transition-opacity z-20 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>

            <div class="absolute bottom-4 right-4 flex space-x-2 z-10">
                @foreach($headlines as $index => $h)
                    <div class="slider-dot w-2 h-2 rounded-full transition-colors {{ $index === 0 ? 'bg-blue-500' : 'bg-gray-500' }}"></div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-span-12 lg:col-span-4 flex flex-col gap-4 h-auto lg:h-80">
        @foreach($articles->take(2) as $f_article)
            <a href="{{ route('article.show', $f_article->slug) }}" class="group relative block w-full h-64 lg:h-1/2 rounded-2xl overflow-hidden shadow-xl">
                @if($f_article->image)
                    <img src="{{ asset($f_article->image) }}" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" 
                         alt="{{ $f_article->title }}">
                @else
                    <div class="w-full h-full bg-gray-800 flex items-center justify-center text-gray-500">Image non disponible</div>
                @endif
                
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent opacity-90"></div>

                <div class="absolute bottom-0 left-0 w-full p-4 text-white">
                    <span class="inline-block {{ $categoryColors[$f_article->category->slug] ?? 'bg-gray-600' }} text-white text-[10px] font-bold px-2 py-1 rounded-full uppercase mb-2 shadow-sm">
                        {{ $f_article->category->name }}
                    </span>

                    <h3 class="text-lg font-bold mb-1 leading-tight group-hover:text-red-400 transition-colors line-clamp-2">
                        {{ $f_article->title }}
                    </h3>

                    <div class="flex items-center text-xs text-gray-400 font-medium">
                        {{ $f_article->created_at->format('d/m/Y') }}
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <div class="col-span-12 lg:col-span-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
        @foreach($articles->skip(2)->take(6) as $article)
            <a href="{{ route('article.show', $article->slug) }}" class="group relative block w-full h-64 rounded-2xl overflow-hidden shadow-xl">
                <img src="{{ asset($article->image) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                
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
        @endforeach
    </div>

    <div class="col-span-12 lg:col-span-4 bg-gray-800 border border-gray-700 p-4 rounded-xl shadow-lg h-fit">
        <h2 class="font-bold border-b-2 border-blue-500 mb-4 text-center pb-2 uppercase text-blue-400">En direct</h2>
        <div class="space-y-4">
            @foreach($articles->take(2) as $flash)
                <div class="text-xs border-b border-gray-700 pb-2 group cursor-pointer">
                    <span class="text-red-400 font-bold">{{ $flash->created_at->format('H:i') }}</span>
                    <p class="text-gray-300 group-hover:text-white transition-colors mt-1">{{ $flash->title }}</p>
                </div>
            @endforeach
            <div class="text-center pt-2">
                <span class="text-xs text-gray-500 uppercase font-semibold">Flux continu</span>
            </div>
        </div>
    </div>
</div>

   <script>
    /* eslint-disable */
    // @ts-nocheck
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.getElementById('headline-slider');
        if (!slider) return;

        const dots = document.querySelectorAll('.slider-dot');
        const prevBtn = document.getElementById('prev-slide');
        const nextBtn = document.getElementById('next-slide');
        
        // On récupère la valeur depuis l'attribut HTML pour éviter le PHP dans le JS
        const totalSlides = parseInt(slider.dataset.total || "0", 10);
        
        if (totalSlides <= 1) return;
        
        let currentIndex = 0;
        let slideInterval;

        const updateUI = () => {
            slider.style.transform = `translateX(-${currentIndex * 100}%)`;
            dots.forEach((dot, index) => {
                dot.classList.toggle('bg-blue-500', index === currentIndex);
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
            slideInterval = setInterval(nextSlide, 5000);
        };

        const resetAutoSlide = () => {
            clearInterval(slideInterval);
            startAutoSlide();
        };

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