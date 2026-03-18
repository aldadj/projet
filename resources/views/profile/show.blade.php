@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-12 px-4">
    
    {{-- En-tête de page style "Settings" --}}
    <div class="border-b-4 border-[#212121] mb-10 pb-4 flex flex-col md:flex-row justify-between items-end gap-4">
        <div>
            <h1 class="text-5xl font-black uppercase tracking-tighter text-[#212121]">Votre <span class="text-[#bb1919]">Profil</span></h1>
            <p class="text-gray-500 font-bold text-sm uppercase mt-2 tracking-widest">Paramètres du compte ActuPress</p>
        </div>
        
        @if($user->google_id)
            <div class="flex items-center gap-3 bg-white border border-gray-200 px-4 py-2 shadow-sm">
                <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="h-5 w-5" alt="Google">
                <span class="text-[10px] text-[#212121] font-black uppercase tracking-tighter">Authentifié via Google</span>
            </div>
        @endif
    </div>

    <div class="bg-white border border-gray-200 shadow-sm overflow-hidden">
        
        {{-- Bannière d'alerte Succès --}}
        @if(session('success'))
            <div class="bg-[#e7f3f5] border-l-4 border-[#1380a1] text-[#1380a1] p-6 font-bold flex items-center gap-3">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" class="divide-y divide-gray-100">
            @csrf
            @method('PUT')

            {{-- Section : Informations Personnelles --}}
            <div class="p-8 md:p-12 grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div>
                    <h2 class="text-xl font-black uppercase tracking-tight text-[#212121]">Informations</h2>
                    <p class="text-sm text-gray-500 mt-2">Ces détails sont utilisés pour vos interactions sur le site.</p>
                </div>
                
                <div class="lg:col-span-2 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex flex-col gap-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Nom complet</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                                   class="bg-[#f2f2f2] border-b-2 border-transparent p-4 focus:border-[#bb1919] focus:outline-none font-bold text-sm transition-all">
                            @error('name') <span class="text-[#bb1919] text-[10px] font-bold uppercase tracking-tighter mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Adresse Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                                   class="bg-[#f2f2f2] border-b-2 border-transparent p-4 focus:border-[#bb1919] focus:outline-none font-bold text-sm transition-all">
                            @error('email') <span class="text-[#bb1919] text-[10px] font-bold uppercase tracking-tighter mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section : Sécurité --}}
            <div class="p-8 md:p-12 grid grid-cols-1 lg:grid-cols-3 gap-8 bg-[#fdfdfd]">
                <div>
                    <h2 class="text-xl font-black uppercase tracking-tight text-[#212121]">Sécurité</h2>
                    <p class="text-sm text-gray-500 mt-2">Mettez à jour votre mot de passe pour protéger votre compte.</p>
                </div>

                <div class="lg:col-span-2">
                    @if(!$user->google_id)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex flex-col gap-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Nouveau mot de passe</label>
                                <input type="password" name="password" 
                                       class="bg-[#f2f2f2] border-b-2 border-transparent p-4 focus:border-[#bb1919] focus:outline-none font-bold text-sm transition-all" 
                                       placeholder="••••••••">
                                @error('password') <span class="text-[#bb1919] text-[10px] font-bold uppercase tracking-tighter mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex flex-col gap-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Confirmation</label>
                                <input type="password" name="password_confirmation" 
                                       class="bg-[#f2f2f2] border-b-2 border-transparent p-4 focus:border-[#bb1919] focus:outline-none font-bold text-sm transition-all" 
                                       placeholder="••••••••">
                            </div>
                        </div>
                        <p class="text-[10px] text-gray-400 mt-4 font-bold uppercase tracking-tighter italic">Laissez vide pour conserver le mot de passe actuel.</p>
                    @else
                        <div class="p-6 border-2 border-dashed border-gray-200 flex items-center gap-4">
                            <div class="bg-gray-100 p-3 rounded-full">🛡️</div>
                            <div>
                                <p class="text-sm font-bold text-[#212121]">Gestion externe</p>
                                <p class="text-xs text-gray-500">Votre sécurité est gérée par Google. Aucun mot de passe n'est stocké localement.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Barre d'action --}}
            <div class="p-8 bg-gray-50 flex justify-end">
                <button type="submit" 
                        class="bg-[#bb1919] text-white px-10 py-4 font-black uppercase text-xs tracking-[0.2em] hover:bg-[#212121] transition-all shadow-lg active:scale-95">
                    Mettre à jour le profil
                </button>
            </div>
        </form>
    </div>

    {{-- Footer de page spécifique --}}
    <div class="mt-8 flex justify-center gap-8 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">
        <a href="{{ route('home') }}" class="hover:text-[#bb1919]">← Retour Accueil</a>
        <span class="text-gray-200">|</span>
        <button class="hover:text-red-600">Supprimer le compte</button>
    </div>
</div>
@endsection