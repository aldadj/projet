<article class="group border-b border-gray-100 pb-8 flex flex-col h-full">
    @if($article->image)
        <a href="{{ route('article.show', $article->slug) }}" class="h-52 overflow-hidden block mb-4 relative shadow-sm">
            <img src="{{ str_starts_with($article->image, 'http') ? $article->image : asset('storage/' . $article->image) }}" 
                 class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-105">
        </a>
    @endif
    
    <div class="flex flex-col flex-grow">
        <span class="text-[9px] font-black uppercase tracking-[0.2em] {{ str_replace('bg-', 'text-', explode(' ', $categoryColors[$article->category->slug] ?? 'bg-gray-600')[0]) }} mb-2">
            {{ $article->category->name }}
        </span>
        
        <h3 class="text-xl font-black mb-3 leading-tight group-hover:underline decoration-2 underline-offset-4 text-gray-900 uppercase tracking-tighter">
            <a href="{{ route('article.show', $article->slug) }}">{{ $article->title }}</a>
        </h3>

        <p class="text-gray-500 text-sm font-medium leading-relaxed line-clamp-3 mb-4">
            {{ Str::limit($article->content, 140) }}
        </p>

        <div class="flex items-center gap-4 mt-auto pt-4 border-t border-gray-50">
            <button onclick="toggleLike(this, {{ $article->id }})" class="flex items-center gap-1 text-gray-400 hover:text-[#bb1919] transition text-xs font-bold">
                <span class="likes-count">{{ $article->likes_count }}</span> ❤️
            </button>
            <span class="text-[9px] text-gray-400 font-black uppercase ml-auto">
                {{ $article->created_at->format('d M Y') }}
            </span>
        </div>
    </div>
</article>