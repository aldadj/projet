@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-white">Modifier la page "Qui Sommes-Nous"</h1>
        <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-white transition">
            &larr; Retour au tableau de bord
        </a>
    </div>

    <div class="bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-700">
        <form action="{{ route('admin.qsn.update') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label class="block text-sm font-bold mb-2 text-gray-300 uppercase tracking-wider">Contenu de la page</label>
                <textarea name="value" rows="15" class="w-full bg-gray-900 border border-gray-700 text-white p-4 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition placeholder-gray-600">{{ old('value', $qsn->value) }}</textarea>
            </div>
            <button type="submit" class="bg-green-600 hover:bg-green-500 text-white font-bold py-3 px-6 rounded-lg transition-colors flex items-center justify-center gap-2">
                <span>Enregistrer les modifications</span>
            </button>
        </form>
    </div>
</div>
@endsection