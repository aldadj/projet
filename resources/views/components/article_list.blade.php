<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($articles as $article)
        <div class="bg-slate-800 rounded-2xl overflow-hidden border border-slate-700 group hover:border-blue-500/50 transition-all">
            <div class="h-40 bg-slate-700 relative overflow-hidden">
                @if($article->image)
                    <img src="{{ str_starts_with($article->image, 'http') ? $article->image : asset('storage/' . $article->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                @else
                    <div class="w-full h-full flex items-center justify-center text-slate-500 text-xs italic">Sans Image</div>
                @endif
                <div class="absolute top-3 left-3 px-2 py-1 bg-blue-600 text-[10px] font-bold text-white rounded uppercase">
                    {{ $article->category->name }}
                </div>
            </div>
            <div class="p-4">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-[10px] text-slate-400 font-medium">{{ $article->created_at->format('d/m/Y') }}</span>
                </div>
                <h3 class="text-white font-bold text-sm mb-4 line-clamp-2 h-10">{{ $article->title }}</h3>
                <div class="flex gap-2">
                    <a href="{{ route('admin.article.edit', $article->id) }}" class="flex-1 text-center bg-slate-700 hover:bg-slate-600 text-white text-xs font-bold py-2 rounded-lg transition-colors">Modifier</a>
                    <form action="{{ route('admin.article.delete', $article->id) }}" method="POST" onsubmit="return confirm('Supprimer cet article ?');">
                        @csrf @method('DELETE')
                        <button class="bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white p-2 rounded-lg transition-all">🗑️</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <p class="text-slate-500 col-span-full py-10 text-center italic">Aucun article publié.</p>
    @endforelse
</div>
