@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center px-4 py-12">
    <div class="max-w-4xl w-full flex flex-col md:flex-row shadow-[0_40px_100px_-20px_rgba(0,0,0,0.3)] overflow-hidden border border-gray-100">
        
        {{-- Partie Gauche : Identité ActuPress --}}
        <div class="md:w-1/2 bg-[#212121] p-12 text-white flex flex-col justify-between relative overflow-hidden">
            {{-- Motif de fond discret (Lignes de code / Réseau) --}}
            <div class="absolute inset-0 opacity-5 pointer-events-none select-none font-mono text-[10px] leading-tight">
                @for($i = 0; $i < 50; $i++)
                    IP_CONFIG_NET_STRICT_MODE_ACTIVE_{{ rand(100,999) }}<br>
                @endfor
            </div>

            <div class="relative z-10">
                <div class="flex items-center gap-2 mb-8">
                    <span class="w-8 h-8 bg-[#bb1919] flex items-center justify-center font-black text-xl">A</span>
                    <span class="font-black uppercase tracking-[0.3em] text-xs">ActuPress Bureau</span>
                </div>
                <h2 class="text-4xl font-black uppercase tracking-tighter leading-none mb-6">
                    Accès <br><span class="text-[#bb1919]">Sécurisé</span>
                </h2>
                <p class="text-gray-400 text-xs font-bold uppercase tracking-widest leading-relaxed max-w-xs">
                    Interface réservée aux administrateurs et journalistes accrédités.
                </p>
            </div>

            <div class="relative z-10 border-t border-gray-800 pt-6">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">
                    Propulsé par Aldadj Tech &copy; {{ date('Y') }}
                </p>
            </div>
        </div>

        {{-- Partie Droite : Formulaire --}}
        <div class="md:w-1/2 bg-white p-12 flex flex-col justify-center">
            <form action="{{ route('login') }}" method="POST" class="space-y-8">
                @csrf
                
                <div class="space-y-6">
                    {{-- Champ Email --}}
                    <div class="relative group">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 group-focus-within:text-[#bb1919] transition-colors">Identifiant Email</label>
                        <input type="email" name="email" 
                               class="w-full bg-gray-50 border-b-2 border-gray-200 p-3 text-sm font-bold text-[#212121] focus:outline-none focus:border-[#bb1919] focus:bg-white transition-all" 
                               required placeholder="nom@actupress.bf">
                    </div>

                    {{-- Champ Mot de passe --}}
                    <div class="relative group">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 group-focus-within:text-[#bb1919] transition-colors">Mot de passe</label>
                        <input type="password" name="password" 
                               class="w-full bg-gray-50 border-b-2 border-gray-200 p-3 text-sm font-bold text-[#212121] focus:outline-none focus:border-[#bb1919] focus:bg-white transition-all" 
                               required placeholder="••••••••">
                    </div>
                </div>

                <div class="space-y-4">
                    <button type="submit" 
                            class="w-full bg-[#212121] text-white font-black py-4 uppercase text-xs tracking-[0.3em] hover:bg-[#bb1919] transition-all shadow-xl active:scale-[0.98]">
                        Authentification
                    </button>
                    
                    <div class="flex flex-col gap-2">
                        <p class="text-center text-[10px] font-bold text-gray-400 uppercase tracking-tighter">
                            Nouvelle recrue ? 
                            <a href="{{ route('register') }}" class="text-[#bb1919] hover:underline ml-1">Créer un profil</a>
                        </p>
                        <a href="#" class="text-center text-[9px] font-black uppercase tracking-widest text-gray-300 hover:text-gray-500 transition-colors">
                            Identifiants oubliés ?
                        </a>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection