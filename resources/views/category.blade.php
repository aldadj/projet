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
        <h1 class="text-3xl font-bold text-slate-900 uppercase border-b-4 border-blue-500 inline-block pb-2">
            {{ $category->name }}
        </h1>
        <p class="text-slate-500 mt-2 text-lg">Retrouvez toute l'actualité et les dossiers de la section {{ $category->name }}.</p>
    </div>
    <a href="{{ route('home') }}" class="text-slate-500 hover:text-slate-900 transition inline-flex items-center gap-2">
        &larr; Retour à l'accueil
    </a>
</div>

<div class="grid grid-cols-2 md:grid-cols-3 gap-6">
    @forelse($articles as $article)
        <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col border border-gray-100 hover:-translate-y-1">
            @if($article->image)
                <a href="{{ route('article.show', $article->slug) }}" class="h-48 overflow-hidden block">
                    <img src="{{ str_starts_with($article->image, 'http') ? $article->image : asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                </a>
            @endif
            <div class="p-4 flex flex-col flex-grow">
                {{-- La catégorie est déjà connue sur cette page, on peut l'omettre pour alléger --}}
                <h3 class="text-lg font-bold mb-2 leading-tight group-hover:text-blue-600 transition-colors line-clamp-3 flex-grow text-slate-900">
                    <a href="{{ route('article.show', $article->slug) }}" class="hover:underline decoration-blue-500 underline-offset-2">{{ $article->title }}</a>
                </h3>

                @if(!$article->image)
                    <p class="text-gray-600 text-sm line-clamp-4 mb-3">
                        {{ $article->content }}
                    </p>
                    <a href="{{ route('article.show', $article->slug) }}" class="text-blue-600 text-xs font-bold uppercase hover:underline mt-auto block mb-2">Voir plus &rarr;</a>
                @endif

                <div class="flex items-center justify-between mt-auto pt-3 border-t border-gray-100">
                    <span class="text-xs text-gray-500 font-medium">{{ $article->created_at->format('d/m/Y') }}</span>
                    
                    {{-- Icônes --}}
                    <div class="flex items-center gap-3">
                        <button onclick="toggleLike(this, {{ $article->id }})" class="flex items-center gap-1 transition {{ $article->is_liked ? 'text-red-500' : 'text-gray-500 hover:text-red-500' }}" title="J'aime">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="{{ $article->is_liked ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" /></svg>
                            <span class="text-xs font-bold likes-count">{{ $article->likes_count }}</span>
                        </button>
                        <button onclick="shareArticle('{{ addslashes($article->title) }}', '{{ route('article.show', $article->slug) }}')" class="text-gray-500 hover:text-blue-500 transition" title="Partager">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.287.696.287 1.093 0 .397-.107.769-.287 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" /></svg>
                        </button>
                        @auth
                            <a href="{{ route('admin.article.edit', $article->id) }}" class="text-gray-500 hover:text-yellow-500" title="Modifier">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.691 1.127l-3.533 1.06a.75.75 0 00-.94-.94l1.06-3.533a4.5 4.5 0 011.127-1.691L16.862 4.487zm0 0L19.5 7.125" /></svg>
                            </a>
                            <form action="{{ route('admin.article.delete', $article->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr ?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-gray-500 hover:text-red-500" title="Supprimer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
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