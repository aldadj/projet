<?php $__env->startSection('content'); ?>
<?php
    $categoryColors = [
        'sport' => 'bg-red-600',
        'politique' => 'bg-blue-800',
        'technologie' => 'bg-green-600',
        'culture' => 'bg-purple-600',
        'economie' => 'bg-yellow-600',
    ];
?>

<div class="grid grid-cols-12 gap-6"> 
    <div class="col-span-12 lg:col-span-8 flex flex-col gap-6">
        <div class="h-80 overflow-hidden rounded-2xl shadow-xl relative group">
            <div id="headline-slider" data-total="<?php echo e($headlines->count()); ?>" class="flex h-full transition-transform duration-700 ease-in-out">
                <?php $__currentLoopData = $headlines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $headline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('article.show', $headline->slug)); ?>" class="min-w-full h-full relative block <?php echo e(!$headline->image ? 'bg-gray-800 p-8 flex flex-col justify-center' : ''); ?>">
                        
                        <?php if($headline->image): ?>
                            <img src="<?php echo e(str_starts_with($headline->image, 'http') ? $headline->image : asset('storage/' . $headline->image)); ?>"
                                 class="w-full h-full object-cover">
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent opacity-90"></div>

                            <div class="absolute bottom-0 left-0 w-full p-4 text-white">
                                <span class="inline-block <?php echo e($categoryColors[$headline->category->slug] ?? 'bg-gray-600'); ?> text-white text-[10px] font-bold px-2 py-1 rounded-full uppercase mb-2 shadow-sm">
                                    <?php echo e($headline->category->name); ?>

                                </span>

                                <h2 class="text-2xl font-bold mb-1 leading-tight hover:text-red-400 transition-colors">
                                    <?php echo e($headline->title); ?>

                                </h2>

                                <div class="flex items-center text-xs text-gray-400 font-medium">
                                    <?php echo e($headline->created_at->format('d/m/Y')); ?>

                                </div>
                            </div>
                        <?php else: ?>
                            <div class="w-full">
                                <span class="inline-block <?php echo e($categoryColors[$headline->category->slug] ?? 'bg-gray-600'); ?> text-white text-[10px] font-bold px-2 py-1 rounded-full uppercase mb-3 shadow-sm">
                                    <?php echo e($headline->category->name); ?>

                                </span>
                                <h2 class="text-3xl font-bold mb-3 leading-tight text-white hover:text-red-400 transition-colors">
                                    <?php echo e($headline->title); ?>

                                </h2>
                                <p class="text-gray-300 text-base line-clamp-3 mb-4 max-w-3xl">
                                    <?php echo e($headline->content); ?>

                                </p>
                                <div class="flex items-center justify-between">
                                    <span class="text-blue-400 text-sm font-bold uppercase hover:underline">Lire l'article &rarr;</span>
                                    <span class="text-xs text-gray-500 font-medium"><?php echo e($headline->created_at->format('d/m/Y')); ?></span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <button id="prev-slide" class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white p-2 rounded-full opacity-0 group-hover:opacity-100 transition-opacity z-20 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </button>
            <button id="next-slide" class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white p-2 rounded-full opacity-0 group-hover:opacity-100 transition-opacity z-20 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>

            <div class="absolute bottom-4 right-4 flex space-x-2 z-10">
                <?php $__currentLoopData = $headlines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="slider-dot w-2 h-2 rounded-full transition-colors <?php echo e($index === 0 ? 'bg-blue-500' : 'bg-gray-500'); ?>"></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <div class="col-span-12 lg:col-span-4 flex flex-col gap-4 h-auto lg:h-80">
        <?php $__currentLoopData = $articles->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f_article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('article.show', $f_article->slug)); ?>" class="group relative block w-full h-64 lg:h-1/2 rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 border border-gray-100 <?php echo e(!$f_article->image ? 'bg-white p-5 flex flex-col' : ''); ?>">
                <?php if($f_article->image): ?>
                    <img src="<?php echo e(str_starts_with($f_article->image, 'http') ? $f_article->image : asset('storage/' . $f_article->image)); ?>"
                    alt="<?php echo e($f_article->title); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent opacity-90"></div>

                    <div class="absolute bottom-0 left-0 w-full p-4 text-white">
                        <span class="inline-block <?php echo e($categoryColors[$f_article->category->slug] ?? 'bg-gray-600'); ?> text-white text-[10px] font-bold px-2 py-1 rounded-full uppercase mb-2 shadow-sm">
                            <?php echo e($f_article->category->name); ?>

                        </span>

                        <h3 class="text-lg font-bold mb-1 leading-tight group-hover:text-red-400 transition-colors line-clamp-2">
                            <?php echo e($f_article->title); ?>

                        </h3>

                        <div class="flex items-center text-xs text-gray-400 font-medium">
                            <?php echo e($f_article->created_at->format('d/m/Y')); ?>

                        </div>
                    </div>
                <?php else: ?>
                    <div class="flex-grow">
                        <span class="inline-block <?php echo e($categoryColors[$f_article->category->slug] ?? 'bg-gray-600'); ?> text-white text-[10px] font-bold px-2 py-1 rounded-full uppercase mb-2 shadow-sm">
                            <?php echo e($f_article->category->name); ?>

                        </span>
                        <h3 class="text-lg font-bold mb-2 leading-tight group-hover:text-blue-600 transition-colors line-clamp-2 text-gray-900">
                            <?php echo e($f_article->title); ?>

                        </h3>
                        <p class="text-gray-600 text-xs line-clamp-3 mb-2">
                            <?php echo e($f_article->content); ?>

                        </p>
                    </div>
                    <div class="flex items-center justify-between mt-auto">
                        <span class="text-xs text-gray-500 font-medium"><?php echo e($f_article->created_at->format('d/m/Y')); ?></span>
                        <span class="text-blue-400 text-xs font-bold uppercase hover:underline">Voir plus &rarr;</span>
                    </div>
                <?php endif; ?>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <div class="col-span-12 lg:col-span-8 grid grid-cols-1 md:grid-cols-2 gap-6">
        <?php $__currentLoopData = $articles->skip(2)->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="group <?php echo e($article->image ? 'bg-white shadow-sm hover:shadow-xl border border-gray-200/60' : 'bg-transparent border-b border-slate-200'); ?> transition-all duration-300 rounded-2xl overflow-hidden flex flex-col">
                <?php if($article->image): ?>
                    <a href="<?php echo e(route('article.show', $article->slug)); ?>" class="h-48 overflow-hidden block">
                        <img src="<?php echo e(str_starts_with($article->image, 'http') ? $article->image : asset('storage/' . $article->image)); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </a>
                <?php endif; ?>
                
                <div class="flex flex-col flex-grow p-4">
                    <span class="inline-block <?php echo e($categoryColors[$article->category->slug] ?? 'bg-gray-600'); ?> text-white text-[10px] font-bold px-2 py-1 rounded-full uppercase mb-3 shadow-sm self-start">
                        <?php echo e($article->category->name); ?>

                    </span>
                    
                    <h3 class="text-xl font-bold mb-2 leading-snug group-hover:text-blue-700 transition-colors line-clamp-3 flex-grow text-slate-900 font-heading">
                        <a href="<?php echo e(route('article.show', $article->slug)); ?>"><?php echo e($article->title); ?></a>
                    </h3>
                    
                    <?php if(!$article->image): ?>
                        <p class="text-slate-600 text-sm line-clamp-3 mb-3 leading-relaxed">
                            <?php echo e($article->content); ?>

                        </p>
                        <a href="<?php echo e(route('article.show', $article->slug)); ?>" class="text-blue-600 text-xs font-bold uppercase hover:underline mb-2 inline-block">Lire l'article &rarr;</a>
                    <?php endif; ?>

                    
                    <div class="flex items-center gap-3 mt-3 pt-3 border-t border-gray-100">
                        <button onclick="toggleLike(this, <?php echo e($article->id); ?>)" class="flex items-center gap-1 transition <?php echo e($article->is_liked ? 'text-red-500' : 'text-gray-400 hover:text-red-500'); ?>" title="J'aime">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="<?php echo e($article->is_liked ? 'currentColor' : 'none'); ?>" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" /></svg>
                            <span class="text-xs font-bold likes-count"><?php echo e($article->likes_count); ?></span>
                        </button>
                        <button onclick="shareArticle('<?php echo e(addslashes($article->title)); ?>', '<?php echo e(route('article.show', $article->slug)); ?>')" class="text-gray-400 hover:text-blue-500 transition" title="Partager">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.287.696.287 1.093 0 .397-.107.769-.287 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" /></svg>
                        </button>
                        <?php if(auth()->guard()->check()): ?>
                            <div class="ml-auto flex gap-2">
                                <a href="<?php echo e(route('admin.article.edit', $article->id)); ?>" class="p-1.5 rounded-full hover:bg-yellow-50 text-gray-400 hover:text-yellow-600 transition" title="Modifier">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.691 1.127l-3.533 1.06a.75.75 0 00-.94-.94l1.06-3.533a4.5 4.5 0 011.127-1.691L16.862 4.487zm0 0L19.5 7.125" /></svg>
                                </a>
                                <form action="<?php echo e(route('admin.article.delete', $article->id)); ?>" method="POST" onsubmit="return confirm('Supprimer ?');" class="inline">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="p-1.5 rounded-full hover:bg-red-50 text-gray-400 hover:text-red-600 transition" title="Supprimer">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                                    </button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <div class="col-span-12 lg:col-span-4 bg-white border border-gray-100 p-5 rounded-2xl shadow-lg h-[600px] flex flex-col relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500"></div>
        <h2 class="font-black text-xl mb-4 text-slate-800 flex items-center gap-2">
            <span class="relative flex h-3 w-3"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span><span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span></span>
            En direct
        </h2>
        
        
        <div class="space-y-4 overflow-y-auto pr-2 custom-scrollbar flex-grow">
            <?php $__currentLoopData = $articles->take(15); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flash): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('article.show', $flash->slug)); ?>" class="block p-3 rounded-lg hover:bg-slate-50 transition-colors group border-l-2 border-transparent hover:border-blue-500">
                    <span class="text-red-500 text-xs font-bold bg-red-50 px-2 py-0.5 rounded-full"><?php echo e($flash->created_at->format('H:i')); ?></span>
                    <p class="text-slate-800 group-hover:text-blue-600 transition-colors mt-1 font-semibold text-sm leading-snug"><?php echo e($flash->title); ?></p>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    
    <div class="col-span-12 mt-8">
        <h3 class="text-2xl font-bold mb-6 text-slate-800 border-l-4 border-blue-500 pl-3">Autres Actualités</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__currentLoopData = $articles->skip(6)->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 flex flex-col hover:-translate-y-1">
                    <a href="<?php echo e(route('article.show', $article->slug)); ?>" class="h-40 overflow-hidden block">
                        <img src="<?php echo e(str_starts_with($article->image, 'http') ? $article->image : asset('storage/' . $article->image)); ?>" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                    </a>
                    <div class="p-4 flex flex-col flex-grow">
                        <span class="text-xs font-bold text-blue-600 uppercase mb-1"><?php echo e($article->category->name); ?></span>
                        <h4 class="font-bold text-sm mb-2 leading-tight line-clamp-2">
                            <a href="<?php echo e(route('article.show', $article->slug)); ?>"><?php echo e($article->title); ?></a>
                        </h4>
                        
                        <div class="flex items-center gap-3 mt-auto pt-3 border-t border-gray-100">
                            <button onclick="toggleLike(this, <?php echo e($article->id); ?>)" class="flex items-center gap-1 transition <?php echo e($article->is_liked ? 'text-red-500' : 'text-gray-400 hover:text-red-500'); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="<?php echo e($article->is_liked ? 'currentColor' : 'none'); ?>" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" /></svg>
                                <span class="text-xs font-bold likes-count"><?php echo e($article->likes_count); ?></span>
                            </button>
                            <button onclick="shareArticle('<?php echo e(addslashes($article->title)); ?>', '<?php echo e(route('article.show', $article->slug)); ?>')" class="text-gray-400 hover:text-blue-500 transition"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.287.696.287 1.093 0 .397-.107.769-.287 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" /></svg></button>
                            
                            <?php if(auth()->guard()->check()): ?>
                                <div class="ml-auto flex gap-2">
                                    <a href="<?php echo e(route('admin.article.edit', $article->id)); ?>" class="p-1 rounded-full hover:bg-yellow-50 text-gray-400 hover:text-yellow-600 transition"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.691 1.127l-3.533 1.06a.75.75 0 00-.94-.94l1.06-3.533a4.5 4.5 0 011.127-1.691L16.862 4.487zm0 0L19.5 7.125" /></svg></a>
                                    <form action="<?php echo e(route('admin.article.delete', $article->id)); ?>" method="POST" onsubmit="return confirm('Supprimer ?');"> <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?> <button type="submit" class="p-1 rounded-full hover:bg-red-50 text-gray-400 hover:text-red-600 transition"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg></button></form>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.getElementById('headline-slider');
        if (!slider) return;

        const dots = document.querySelectorAll('.slider-dot');
        const prevBtn = document.getElementById('prev-slide');
        const nextBtn = document.getElementById('next-slide');
        const totalSlides = parseInt(slider.dataset.total || "0", 10);
        
        if (totalSlides <= 1) return;
        
        let currentIndex = 0;
        let slideInterval;

        const updateUI = () => {
            slider.style.transform = `translateX(-${currentIndex * 100}%)`;
            dots.forEach((dot, index) => {
                dot.classList.toggle('bg-blue-500', index === currentIndex);
                dot.classList.toggle('bg-gray-500', index !== currentIndex);
            });
        };

        const nextSlide = () => {
            currentIndex = (currentIndex + 1) % totalSlides;
            updateUI();
        };

        const prevSlide = () => {
            currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
            updateUI();
        };

        const startAutoSlide = () => {
            slideInterval = setInterval(nextSlide, 5000);
        };

        const resetAutoSlide = () => {
            clearInterval(slideInterval);
            startAutoSlide();
        };

        if (nextBtn) {
            nextBtn.addEventListener('click', () => { nextSlide(); resetAutoSlide(); });
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', () => { prevSlide(); resetAutoSlide(); });
        }

        startAutoSlide();
    });

    /* CSS pour la scrollbar customisée (optionnel) */
    const style = document.createElement('style');
    style.textContent = `
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    `;
    document.head.appendChild(style);
</script>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('js/sliderWelcome.js')); ?>" defer></script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\alisn\Desktop\LARAVEL\projet\resources\views/welcome.blade.php ENDPATH**/ ?>