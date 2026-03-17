@extends('layouts.app') {{-- Assurez-vous que ce layout est le bon pour votre admin --}}

@section('content')
<div class="bg-slate-800 p-8 rounded-2xl shadow-2xl w-full border border-slate-700 max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-white">Créer un nouvel article</h1>
        <a href="{{ route('admin.dashboard') }}" class="text-slate-400 hover:text-white transition">&larr; Retour au dashboard</a>
    </div>

    {{-- Bloc pour afficher les erreurs de validation --}}
    @if ($errors->any())
        <div class="bg-red-500/10 border border-red-500 text-red-400 px-4 py-3 rounded-lg mb-6 text-sm">
            <strong class="font-bold">Oups !</strong>
            <span class="block sm:inline">Il y a eu quelques problèmes avec votre saisie.</span>
            <ul class="mt-3 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.article.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label for="title" class="block text-sm font-bold mb-2 text-slate-300 uppercase tracking-wider">Titre</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" class="w-full bg-slate-900 border border-slate-600 text-white p-3 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition" required>
        </div>

        <div>
            <label for="category_id" class="block text-sm font-bold mb-2 text-slate-300 uppercase tracking-wider">Catégorie</label>
            <select id="category_id" name="category_id" class="w-full bg-slate-900 border border-slate-600 text-white p-3 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                <option value="">-- Choisir une catégorie --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="content" class="block text-sm font-bold mb-2 text-slate-300 uppercase tracking-wider">Contenu</label>
            <textarea id="content" name="content" rows="10" class="w-full bg-slate-900 border border-slate-600 text-white p-3 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition" required>{{ old('content') }}</textarea>
        </div>

        <div>
            <label for="image" class="block text-sm font-bold mb-2 text-slate-300 uppercase tracking-wider">Image de couverture</label>
            <input type="file" id="image" name="image" class="w-full text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200 cursor-pointer">
        </div>

        <div id="preview-container" class="hidden mt-4">
            <p class="text-sm font-bold mb-2 text-slate-300 uppercase tracking-wider">Aperçu de l'image :</p>
            <img id="image-preview" src="#" class="h-40 w-full object-cover rounded-lg border border-slate-600">
        </div>

        <div class="flex items-center pt-2">
            <input type="checkbox" id="is_headline" name="is_headline" value="1" {{ old('is_headline') ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-600 bg-slate-900 text-blue-600 focus:ring-blue-500">
            <label for="is_headline" class="ml-3 block text-sm text-slate-300">Mettre cet article "À la une"</label>
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit" class="bg-blue-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-500 transition-all transform hover:scale-105">
                Enregistrer l'article
            </button>
        </div>
    </form>
</div>
@endsection

<script>
    document.getElementById('image').onchange = evt => {
        const [file] = document.getElementById('image').files
        if (file) {
            document.getElementById('preview-container').classList.remove('hidden');
            document.getElementById('image-preview').src = URL.createObjectURL(file)
        }
    }
</script>