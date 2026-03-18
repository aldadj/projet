@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-12 bg-[#f8f8f8]">
    <div class="max-w-5xl w-full flex flex-col md:flex-row shadow-[0_40px_100px_-20px_rgba(0,0,0,0.3)] overflow-hidden border border-gray-100">
        
        {{-- Partie Gauche : Identité & Message --}}
        <div class="md:w-5/12 bg-[#212121] p-12 text-white flex flex-col justify-between relative overflow-hidden">
            {{-- Filigrane graphique --}}
            <div class="absolute inset-0 opacity-10 pointer-events-none select-none flex items-center justify-center">
                <span class="text-[15rem] font-black italic rotate-12">NEWS</span>
            </div>

            <div class="relative z-10">
                <div class="flex items-center gap-2 mb-10">
                    <span class="w-10 h-10 bg-[#bb1919] flex items-center justify-center font-black text-2xl shadow-lg">A</span>
                    <span class="font-black uppercase tracking-[0.3em] text-[10px]">Rejoindre la Rédaction</span>
                </div>
                <h2 class="text-5xl font-black uppercase tracking-tighter leading-[0.85] mb-8">
                    Créez votre <br><span class="text-[#bb1919]">Compte.</span>
                </h2>
                <p class="text-gray-400 text-xs font-bold uppercase tracking-widest leading-relaxed max-w-xs">
                    Devenez acteur de l'information. Accédez aux outils de publication et de gestion d'ActuPress.
                </p>
            </div>

            <div class="relative z-10 border-t border-gray-800 pt-8 mt-12">
                <p class="text-[10px] font-black uppercase tracking-widest text-gray-500 mb-2">Déjà membre de l'équipe ?</p>
                <a href="{{ route('login') }}" class="inline-block bg-white text-[#212121] px-6 py-3 font-black uppercase text-[10px] tracking-widest hover:bg-[#bb1919] hover:text-white transition-all">
                    Se Connecter →
                </a>
            </div>
        </div>

        {{-- Partie Droite : Formulaire d'Inscription --}}
        <div class="md:w-7/12 bg-white p-12 flex flex-col justify-center">
            <form action="{{ route('register.post') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Nom Complet --}}
                    <div class="md:col-span-2 group">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 group-focus-within:text-[#bb1919] transition-colors">Nom complet du collaborateur</label>
                        <input type="text" name="name" value="{{ old('name') }}" 
                               class="w-full bg-gray-50 border-b-2 border-gray-200 p-3 text-sm font-bold text-[#212121] focus:outline-none focus:border-[#bb1919] focus:bg-white transition-all" 
                               required placeholder="Ex: Ali Belem">
                        @error('name') <p class="text-[#bb1919] text-[10px] font-bold uppercase mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Email --}}
                    <div class="md:col-span-2 group">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 group-focus-within:text-[#bb1919] transition-colors">Adresse Email Professionnelle</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full bg-gray-50 border-b-2 border-gray-200 p-3 text-sm font-bold text-[#212121] focus:outline-none focus:border-[#bb1919] focus:bg-white transition-all" 
                               required placeholder="belem@actupress.bf">
                        @error('email') <p class="text-[#bb1919] text-[10px] font-bold uppercase mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Mot de passe --}}
                    <div class="group">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 group-focus-within:text-[#bb1919] transition-colors">Mot de passe</label>
                        <input type="password" name="password" 
                               class="w-full bg-gray-50 border-b-2 border-gray-200 p-3 text-sm font-bold text-[#212121] focus:outline-none focus:border-[#bb1919] focus:bg-white transition-all" 
                               required placeholder="••••••••">
                    </div>

                    {{-- Confirmation --}}
                    <div class="group">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 group-focus-within:text-[#bb1919] transition-colors">Confirmer</label>
                        <input type="password" name="password_confirmation" 
                               class="w-full bg-gray-50 border-b-2 border-gray-200 p-3 text-sm font-bold text-[#212121] focus:outline-none focus:border-[#bb1919] focus:bg-white transition-all" 
                               required placeholder="••••••••">
                    </div>
                </div>

                <div class="pt-6 space-y-6">
                    <button type="submit" 
                            class="w-full bg-[#212121] text-white font-black py-4 uppercase text-xs tracking-[0.3em] hover:bg-[#bb1919] transition-all shadow-xl active:scale-[0.98]">
                        Créer mon profil
                    </button>

                    {{-- Séparateur --}}
                    <div class="relative flex items-center">
                        <div class="flex-grow border-t border-gray-100"></div>
                        <span class="flex-shrink mx-4 text-[10px] font-black uppercase text-gray-300 tracking-widest">OU</span>
                        <div class="flex-grow border-t border-gray-100"></div>
                    </div>

                    {{-- Google Login --}}
                    <a href="{{ route('auth.google') }}" 
                       class="w-full flex items-center justify-center gap-3 py-3 border-2 border-gray-100 text-[10px] font-black uppercase tracking-widest text-[#212121] hover:bg-gray-50 transition-all">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="h-4 w-4" alt="Google">
                        Continuer avec Google
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection