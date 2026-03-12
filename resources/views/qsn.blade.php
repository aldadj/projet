@extends('layouts.app')

@section('content')
<div class="relative bg-slate-900 py-16 sm:py-24">
    <div class="absolute inset-0 opacity-10">
        {{-- Background pattern --}}
        <div class="absolute inset-0 bg-grid-slate-700/[0.05] [mask-image:linear-gradient(0deg,transparent,black)]"></div>
    </div>

    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="absolute top-0 right-0 px-4 sm:px-6 lg:px-8 mt-[-2rem]">
            <a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition inline-flex items-center gap-2">&larr; Retour à l'accueil</a>
        </div>
        <div class="text-center">
            <p class="text-base font-semibold text-blue-400 tracking-wider uppercase">Notre Histoire</p>
            <h1 class="mt-2 text-4xl font-extrabold text-white tracking-tight sm:text-5xl">
                Qui Sommes-Nous ?
            </h1>
            <p class="mt-5 max-w-2xl mx-auto text-xl text-slate-400">
                Découvrez l'équipe et la mission derrière ACTUPRESS.
            </p>
        </div>
        <div class="mt-12 bg-slate-800/50 backdrop-blur-sm p-8 sm:p-12 shadow-2xl rounded-3xl border border-slate-700 prose prose-invert max-w-none text-slate-300 leading-relaxed text-lg">
            {!! nl2br(e($qsn->value ?? 'Contenu en cours de rédaction...')) !!}
        </div>
    </div>
</div>
@endsection