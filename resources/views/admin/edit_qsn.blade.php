@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-12">
    
    {{-- En-tête : Style Editorial --}}
    <div class="flex flex-col md:flex-row justify-between items-end mb-10 border-b-8 border-[#212121] pb-6 gap-4">
        <div>
            <div class="flex items-center gap-2 mb-2">
                <span class="bg-[#bb1919] text-white text-[10px] font-black px-2 py-0.5 uppercase tracking-widest">Configuration</span>
                <span class="text-gray-400 text-[10px] font-black uppercase tracking-widest">Page Publique</span>
            </div>
            <h1 class="text-5xl font-black text-[#212121] uppercase tracking-tighter">Édition <span class="text-[#bb1919]">QSN</span></h1>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-2 text-xs font-black uppercase tracking-widest text-gray-400 hover:text-[#212121] transition-colors">
            <span class="transform group-hover:-translate-x-1 transition-transform">←</span> Annuler & Retour
        </a>
    </div>

    <div class="grid lg:grid-cols-12 gap-8">
        
        {{-- Colonne Principale d'Écriture --}}
        <div class="lg:col-span-9">
            <div class="bg-white border border-gray-200 shadow-sm p-2">
                <div class="bg-[#fcfcfc] border border-gray-100 p-8">
                    <form action="{{ route('admin.qsn.update') }}" method="POST">
                        @csrf
                        <div class="mb-8">
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-4 flex items-center gap-2">
                                <span class="w-2 h-2 bg-[#bb1919]"></span>
                                Récit de l'institution ActuPress
                            </label>
                            
                            <div class="relative">
                                <textarea name="value" rows="20" 
                                          class="w-full bg-white border-l-4 border-gray-200 p-8 text-xl font-serif leading-relaxed text-[#333] focus:outline-none focus:border-[#bb1919] focus:bg-white transition-all resize-none shadow-sm"
                                          placeholder="Racontez votre histoire...">{{ old('value', $qsn->value) }}</textarea>
                                
                                <div class="absolute top-0 right-0 p-4 opacity-10 pointer-events-none select-none">
                                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zM6 20V4h7v5h5v11H6z"/></svg>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" 
                                    class="bg-[#bb1919] text-white px-12 py-5 font-black uppercase text-xs tracking-[0.2em] hover:bg-[#212121] transition-all shadow-xl active:scale-95 flex items-center gap-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                Enregistrer le manifeste
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Colonne Info / Aide --}}
        <div class="lg:col-span-3 space-y-6">
            <div class="bg-[#212121] p-6 text-white">
                <h3 class="text-[10px] font-black uppercase tracking-widest text-[#bb1919] mb-4">Aperçu rapide</h3>
                <p class="text-xs text-gray-400 leading-relaxed font-bold uppercase tracking-tighter">
                    Ce texte est la première chose que vos lecteurs voient pour juger de votre crédibilité. 
                </p>
                <div class="mt-6 pt-6 border-t border-gray-800">
                    <a href="{{ route('qsn') }}" target="_blank" class="text-white text-[10px] font-black uppercase tracking-widest flex items-center gap-2 hover:text-[#bb1919] transition-colors">
                        Voir la page live 
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" stroke-width="2.5"/></svg>
                    </a>
                </div>
            </div>

            <div class="p-6 border-2 border-dashed border-gray-200">
                <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Conseil éditorial</p>
                <p class="text-[11px] text-gray-500 italic leading-relaxed">
                    Utilisez un ton formel. Mentionnez vos valeurs, votre équipe et votre engagement envers l'information au Burkina Faso.
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    /* Confort d'écriture : Style Papier */
    textarea {
        font-family: 'Georgia', serif;
        background-image: linear-gradient(#f1f1f1 1px, transparent 1px);
        background-size: 100% 3rem; /* Simule des lignes de cahier subtiles */
        line-height: 3rem !important;
    }
</style>
@endsection