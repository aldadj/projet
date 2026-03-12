@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-white">Détail du message</h1>
        <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-white transition">
            &larr; Retour au tableau de bord
        </a>
    </div>

    <div class="bg-gray-800 rounded-xl shadow-lg border border-gray-700 overflow-hidden">
        {{-- En-tête du message --}}
        <div class="p-6 border-b border-gray-700 bg-gray-900/30 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-gray-400 text-sm uppercase tracking-wider font-bold">De :</span>
                    <span class="text-lg font-bold text-white">{{ $message->name }}</span>
                </div>
                <a href="mailto:{{ $message->email }}" class="text-blue-400 hover:text-blue-300 text-sm flex items-center gap-1 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                    {{ $message->email }}
                </a>
            </div>
            <div class="text-gray-400 text-sm bg-gray-700/50 px-3 py-1 rounded-full">
                Reçu le {{ $message->created_at->format('d/m/Y à H:i') }}
            </div>
        </div>
        
        {{-- Corps du message --}}
        <div class="p-8">
            <h2 class="text-xl font-bold text-white mb-6 border-l-4 border-blue-500 pl-4">
                {{ $message->subject }}
            </h2>
            
            <div class="prose prose-invert max-w-none text-gray-300 leading-relaxed bg-gray-900/50 p-6 rounded-lg border border-gray-700/50">
                {!! nl2br(e($message->message)) !!}
            </div>
        </div>
    </div>
</div>
@endsection
