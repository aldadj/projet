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

{{-- Fil d'Ariane (Breadcrumb) --}}
<div class="mb-6 flex items-center text-sm text-gray-400 overflow-hidden">
    <a href="{{ route('home') }}" class="hover:text-white transition flex-shrink-0 flex items-center gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" /></svg>
        Accueil
    </a>
    <span class="mx-2 flex-shrink-0">/</span>
    <a href="{{ route('category.show', $article->category->slug) }}" class="hover:text-white transition uppercase font-bold flex-shrink-0">
        {{ $article->category->name }}
    </a>
    <span class="mx-2 flex-shrink-0">/</span>
    <span class="text-gray-500 truncate">{{ $article->title }}</span>
</div>

<div class="bg-gray-800 p-8 shadow-xl rounded-2xl border border-gray-700">
    
    <div class="flex flex-col md:flex-row gap-6 mb-8">
        {{-- Image de l'article avec vérification Cloudinary --}}
        @if($article->image)
            <div class="w-full md:w-1/3 h-64 bg-gray-700 rounded-xl overflow-hidden shadow-lg">
                <img src="{{ str_starts_with($article->image, 'http') ? $article->image : asset('storage/' . $article->image) }}"
                     class="w-full h-full object-cover">
            </div>
        @endif

        <div class="w-full {{ $article->image ? 'md:w-2/3' : '' }}">
            <h1 class="text-3xl font-bold mb-4 text-white leading-tight">{{ $article->title }}</h1>
            <div class="flex gap-2 mb-4">
                <span class="inline-block {{ $categoryColors[$article->category->slug] ?? 'bg-gray-600' }} text-white text-xs font-bold px-3 py-1 rounded-full uppercase shadow-sm">
                    {{ $article->category->name }}
                </span>
                <span class="text-gray-400 text-sm italic flex items-center">
                    <span class="mr-1">•</span> {{ $article->created_at->format('d/m/Y') }}
                </span>
            </div>
        </div>
    </div>

    <div class="border-t border-gray-700 pt-8 mb-12">
        <div class="prose max-w-none text-gray-300 leading-relaxed text-lg">
            {!! nl2br(e($article->content)) !!}
        </div>
    </div>

    {{-- Section Articles Similaires --}}
    <div class="border-t border-gray-700 pt-8">
        <h3 class="font-bold mb-6 uppercase text-blue-400 tracking-wider">Articles Similaires</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($similaires as $item)
                <a href="{{ route('article.show', $item->slug) }}" class="group relative block w-full h-64 rounded-2xl overflow-hidden shadow-xl">
                    {{-- Image des articles similaires avec vérification Cloudinary --}}
                    @if($item->image)
                        <img src="{{ str_starts_with($item->image, 'http') ? $item->image : asset('storage/' . $item->image) }}"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    @endif

                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent opacity-90"></div>

                    <div class="absolute bottom-0 left-0 w-full p-4 text-white">
                        <span class="inline-block {{ $categoryColors[$item->category->slug] ?? 'bg-gray-600' }} text-white text-[10px] font-bold px-2 py-1 rounded-full uppercase mb-2 shadow-sm">
                            {{ $item->category->name }}
                        </span>

                        <h3 class="text-lg font-bold mb-1 leading-tight group-hover:text-red-400 transition-colors line-clamp-2">
                            {{ $item->title }}
                        </h3>

                        <div class="flex items-center text-xs text-gray-400 font-medium">
                            {{ $item->created_at->format('d/m/Y') }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

</div>
@endsection