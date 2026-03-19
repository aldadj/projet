@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">
    
    {{-- Header --}}
    <div class="flex flex-col md:flex-row justify-between items-end mb-12 border-b-8 border-[#212121] pb-8 gap-6">
        <div>
            <div class="flex items-center gap-2 mb-2">
                <span class="w-3 h-3 bg-[#bb1919] animate-pulse"></span>
                <span class="text-[10px] font-black uppercase tracking-[0.3em] text-[#bb1919]">Système de Gestion en Direct</span>
            </div>
            <h1 class="text-6xl font-black text-[#212121] uppercase tracking-tighter leading-none">Tableau de <span class="text-transparent" style="-webkit-text-stroke: 1.5px #212121;">Bord</span></h1>
            <p class="text-gray-500 font-bold text-sm uppercase mt-4 tracking-widest">Contrôle éditorial : ActuPress Bureau</p>
        </div>
        
        <a href="{{ route('admin.article.create') }}" class="bg-[#212121] text-white font-black py-5 px-10 uppercase text-xs tracking-[0.2em] hover:bg-[#bb1919] transition-all shadow-2xl">
            ⊕ Publier un Article
        </a>
    </div>

    {{-- LES 3 CARTES --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-0 mb-16 border border-gray-200 shadow-sm">
        
        {{-- Carte 1 : Articles --}}
        <div class="bg-white p-10 border-b md:border-b-0 md:border-r border-gray-200 group">
            <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-4 group-hover:text-[#bb1919] transition-colors">Total Publications</p>
            <div class="flex items-baseline gap-2">
                <p class="text-6xl font-black text-[#212121] tracking-tighter">{{ $count_articles ?? 0 }}</p>
                <span class="text-xs font-bold text-gray-400">Articles</span>
            </div>
        </div>

        {{-- Carte 2 : Messages (DEVENUE UN LIEN DE SCROLL) --}}
        <a href="#messages-section" class="bg-[#f8f8f8] p-10 border-b md:border-b-0 md:border-r border-gray-200 group block hover:bg-gray-100 transition-all">
            <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-4 group-hover:text-blue-600 transition-colors">Boîte de Réception</p>
            <div class="flex items-baseline gap-4">
                <p class="text-6xl font-black text-[#212121] tracking-tighter">{{ $unread_messages ?? 0 }}</p>
                <span class="bg-blue-600 text-white text-[10px] px-2 py-1 font-black uppercase tracking-tighter">Non lus</span>
            </div>
            <p class="text-[9px] font-bold text-blue-600 uppercase mt-4 tracking-tighter opacity-0 group-hover:opacity-100 transition-opacity">Cliquer pour voir les messages ↓</p>
        </a>

        {{-- Carte 3 : BOUTON QSN --}}
        <div class="bg-[#212121] p-10 group relative overflow-hidden min-h-[180px] flex flex-col justify-center">
            <div class="relative z-10">
                <p class="text-[10px] font-black uppercase tracking-widest text-[#bb1919] mb-4">Configuration Site</p>
                <h3 class="text-white font-black text-xl uppercase tracking-tighter mb-6 leading-tight">Gérer la page<br>Qui Sommes-Nous</h3>
                <a href="{{ route('admin.qsn.edit') }}" class="inline-block text-[10px] font-black uppercase tracking-widest text-white border-b-2 border-[#bb1919] pb-1 hover:text-[#bb1919] transition-all">
                    Accéder aux réglages →
                </a>
            </div>
            <span class="absolute -right-4 -bottom-4 text-white opacity-5 text-8xl font-black italic select-none">GEAR</span>
        </div>
    </div>

    {{-- Articles --}}
    <div class="mb-20">
        <div class="flex items-center gap-4 mb-8">
            <h2 class="text-2xl font-black uppercase tracking-tighter text-[#212121]">Archives des Articles</h2>
            <div class="h-1 flex-grow bg-gray-100"></div>
        </div>
        <div class="bg-white border border-gray-200 p-2">
             @include('components.article_list', ['articles' => $articles])
        </div>
    </div>
    
    {{-- Messages (AVEC ID POUR LE SCROLL) --}}
    <div id="messages-section" class="border-t-4 border-[#212121] pt-12 scroll-mt-10">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-black uppercase tracking-tighter text-[#212121]">Correspondance Lecteurs</h2>
        </div>

        <div class="bg-white border border-gray-200 overflow-hidden shadow-lg">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#212121] text-white text-[10px] uppercase font-black tracking-widest">
                            <th class="px-8 py-5">Source / Expéditeur</th>
                            <th class="px-8 py-5">Sujet du Message</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($messages as $message)
                            {{-- Ligne cliquable --}}
                            <tr onclick="window.location='{{ route('admin.message.show', $message->id) }}'" 
                                class="hover:bg-gray-50 transition-colors group cursor-pointer">
                                
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-3">
                                        @if(!$message->is_read)
                                            <span class="relative flex h-2 w-2">
                                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#bb1919] opacity-75"></span>
                                                <span class="relative inline-flex rounded-full h-2 w-2 bg-[#bb1919]"></span>
                                            </span>
                                        @else
                                            <span class="h-2 w-2 rounded-full bg-gray-200"></span>
                                        @endif
                                        
                                        <div class="flex flex-col">
                                            <span class="text-sm font-black text-[#212121] uppercase tracking-tighter {{ !$message->is_read ? 'text-[#bb1919]' : '' }}">
                                                {{ $message->name }}
                                            </span>
                                            <span class="text-[9px] text-gray-400 font-bold tracking-widest uppercase">{{ $message->created_at->format('d M Y à H:i') }}</span>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-8 py-6">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm {{ !$message->is_read ? 'font-black text-[#212121]' : 'font-bold text-gray-500' }} italic">
                                            "{{ Str::limit($message->subject, 80) }}"
                                        </span>
                                        <span class="text-[#212121] opacity-0 group-hover:opacity-100 transition-opacity text-[10px] font-black uppercase tracking-widest">
                                            Lire le message →
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="2" class="py-10 text-center text-gray-400 uppercase text-[10px] font-black">Aucun message dans la boîte</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Petit script pour un scroll fluide si pas déjà actif --}}
<style>
    html {
        scroll-behavior: smooth;
    }
</style>
@endsection