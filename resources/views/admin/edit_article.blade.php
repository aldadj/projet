@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    
    {{-- Barre de titre administrative --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4 border-b-4 border-[#212121] pb-6">
        <div>
            <div class="flex items-center gap-2 mb-2">
                <span class="bg-[#bb1919] text-white text-[10px] font-black px-2 py-0.5 uppercase tracking-widest">Admin Mode</span>
                <span class="text-gray-400 text-[10px] font-black uppercase tracking-widest">ID: #{{ $article->id }}</span>
            </div>
            <h1 class="text-4xl font-black text-[#212121] uppercase tracking-tighter">Modifier <span class="text-[#bb1919]">l'Article</span></h1>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-2 text-xs font-black uppercase tracking-widest text-gray-500 hover:text-[#212121] transition-colors">
            <span class="transform group-hover:-translate-x-1 transition-transform">←</span> Retour Dashboard
        </a>
    </div>

    <form action="{{ route('admin.article.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            {{-- ZONE D'ÉDITION PRINCIPALE (8/12) --}}
            <div class="lg:col-span-8 space-y-8">
                <div class="bg-white border border-gray-200 shadow-sm p-8">
                    {{-- Titre --}}
                    <div class="mb-8">
                        <label class="block text-xs font-black uppercase tracking-[0.2em] text-gray-400 mb-3">Titre de la publication</label>
                        <input type="text" name="title" 
                               class="w-full bg-[#f9f9f9] border-l-4 border-[#bb1919] p-4 text-2xl font-bold text-[#212121] focus:outline-none focus:bg-white transition-all" 
                               value="{{ old('title', $article->title) }}" required placeholder="Saisir le titre...">
                    </div>

                    {{-- Éditeur de contenu --}}
                    <div>
                        <label class="block text-xs font-black uppercase tracking-[0.2em] text-gray-400 mb-3">Corps de l'article</label>
                        <div class="relative">
                            <textarea name="content" rows="25" 
                                      class="w-full bg-[#f9f9f9] border border-gray-100 p-6 text-lg font-serif leading-relaxed text-[#333] focus:outline-none focus:bg-white focus:border-gray-300 transition-all resize-none shadow-inner"
                                      placeholder="Rédigez votre contenu ici...">{{ old('content', $article->content) }}</textarea>
                            <div class="absolute bottom-4 right-4 text-[10px] font-black text-gray-300 uppercase tracking-widest">Formatage Simple (HTML autorisé)</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- PANNEAU DE CONFIGURATION LATÉRAL (4/12) --}}
            <div class="lg:col-span-4 space-y-6">
                
                {{-- Bloc Publication --}}
                <div class="bg-[#212121] p-6 text-white shadow-lg">
                    <h3 class="text-xs font-black uppercase tracking-[0.2em] text-[#bb1919] mb-6 flex items-center gap-2">
                        <span class="w-4 h-4 rounded-full border-2 border-[#bb1919] flex items-center justify-center">
                            <span class="w-1.5 h-1.5 bg-[#bb1919] rounded-full"></span>
                        </span>
                        Statut & Publication
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Catégorie</label>
                            <select name="category_id" class="w-full bg-[#333] border-none text-white p-3 text-sm font-bold focus:ring-2 focus:ring-[#bb1919] outline-none transition cursor-pointer">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $article->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="pt-4">
                            <button type="submit" class="w-full bg-[#bb1919] hover:bg-white hover:text-[#212121] text-white font-black py-4 uppercase text-xs tracking-[0.2em] transition-all transform active:scale-95 shadow-xl">
                                Enregistrer les modifications
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Bloc Média --}}
                <div class="bg-white border border-gray-200 p-6 shadow-sm">
                    <h3 class="text-xs font-black uppercase tracking-[0.2em] text-gray-400 mb-6">Média de couverture</h3>
                    
                    @if($article->image)
                        <div class="mb-6 group relative">
                            <img src="{{ str_starts_with($article->image, 'http') ? $article->image : asset('storage/' . $article->image) }}" 
                                 class="w-full h-48 object-cover border border-gray-100 grayscale hover:grayscale-0 transition-all duration-500">
                            <div class="mt-3">
                                <label class="flex items-center gap-2 text-red-600 cursor-pointer hover:bg-red-50 p-2 transition">
                                    <input type="checkbox" name="delete_image" class="accent-red-600">
                                    <span class="text-[10px] font-black uppercase tracking-tighter">Supprimer définitivement</span>
                                </label>
                            </div>
                        </div>
                    @endif

                    <div class="relative">
                        <input type="file" name="image" id="file-upload" class="hidden" onchange="updateFileName(this)">
                        <label for="file-upload" class="flex flex-col items-center justify-center w-full p-8 border-2 border-dashed border-gray-200 bg-gray-50 hover:bg-white hover:border-[#bb1919] transition-all cursor-pointer group">
                            <svg class="w-6 h-6 mb-2 text-gray-400 group-hover:text-[#bb1919] transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" stroke-width="2"/></svg>
                            <span id="file-label" class="text-[10px] font-black uppercase tracking-widest text-gray-400 group-hover:text-[#212121]">Remplacer l'image</span>
                        </label>
                    </div>
                </div>

                {{-- Bloc Info --}}
                <div class="p-6 bg-[#f9f9f9] border border-gray-100">
                    <p class="text-[10px] font-bold text-gray-400 leading-relaxed uppercase">
                        Dernière modification : <br>
                        <span class="text-[#212121]">{{ $article->updated_at->format('d/m/Y à H:i') }}</span>
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function updateFileName(input) {
        const label = document.getElementById('file-label');
        if (input.files && input.files.length > 0) {
            label.innerText = input.files[0].name;
            label.classList.add('text-[#bb1919]');
        }
    }
</script>

<style>
    /* Typographie Serif pour le confort d'écriture */
    textarea {
        font-family: 'Georgia', serif;
    }
</style>
@endsection