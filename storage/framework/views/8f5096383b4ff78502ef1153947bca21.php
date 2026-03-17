<?php $__env->startSection('content'); ?>
<style>
    body { background-color: #ffffff !important; color: #e2e8f0; }
</style>

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
            <a href="<?php echo e(route('article.show', $f_article->slug)); ?>" class="group relative block w-full h-64 lg:h-1/2 rounded-2xl overflow-hidden shadow-xl <?php echo e(!$f_article->image ? 'bg-gray-800 p-5 flex flex-col' : ''); ?>">
                <?php if($f_article->image): ?>
                    <img src="<?php echo e(str_starts_with($f_article->image, 'http') ? $f_article->image : asset('storage/' . $f_article->image)); ?>"
                    alt="<?php echo e($f_article->title); ?>" class="w-full h-full object-cover">
                    
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
                        <h3 class="text-lg font-bold mb-2 leading-tight group-hover:text-blue-400 transition-colors line-clamp-2 text-white">
                            <?php echo e($f_article->title); ?>

                        </h3>
                        <p class="text-gray-400 text-xs line-clamp-3 mb-2">
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

    <div class="col-span-12 lg:col-span-8 grid grid-cols-2 gap-4">
        <?php $__currentLoopData = $articles->skip(2)->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('article.show', $article->slug)); ?>" class="group bg-gray-800/70 hover:bg-gray-800 transition-colors rounded-2xl shadow-lg overflow-hidden flex flex-col border border-gray-700/50 hover:border-blue-500/50">
                <?php if($article->image): ?>
                    <div class="h-48 overflow-hidden">
                        <img src="<?php echo e(str_starts_with($article->image, 'http') ? $article->image : asset('storage/' . $article->image)); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    </div>
                <?php endif; ?>
                <div class="p-4 flex flex-col flex-grow">
                    <span class="inline-block <?php echo e($categoryColors[$article->category->slug] ?? 'bg-gray-600'); ?> text-white text-[10px] font-bold px-2 py-1 rounded-full uppercase mb-3 shadow-sm self-start">
                        <?php echo e($article->category->name); ?>

                    </span>
                    <h3 class="text-md font-bold mb-2 leading-tight group-hover:text-blue-400 transition-colors line-clamp-3 flex-grow text-gray-100">
                        <?php echo e($article->title); ?>

                    </h3>
                    
                    <?php if(!$article->image): ?>
                        <p class="text-gray-400 text-sm line-clamp-4 mb-3">
                            <?php echo e($article->content); ?>

                        </p>
                        <span class="text-blue-400 text-xs font-bold uppercase hover:underline mt-auto">Voir plus &rarr;</span>
                    <?php endif; ?>

                    <div class="flex items-center text-xs text-gray-400 font-medium mt-auto pt-2">
                        <?php echo e($article->created_at->format('d/m/Y')); ?>

                    </div>
                </div>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <div class="col-span-12 lg:col-span-4 bg-gray-800 border border-gray-700 p-4 rounded-xl shadow-lg h-fit">
        <h2 class="font-bold border-b-2 border-blue-500 mb-4 text-center pb-2 uppercase text-blue-400">En direct</h2>
        <div class="space-y-4">
            <?php $__currentLoopData = $articles->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flash): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="text-xs border-b border-gray-700 pb-2 group cursor-pointer">
                    <span class="text-red-400 font-bold"><?php echo e($flash->created_at->format('H:i')); ?></span>
                    <p class="text-gray-300 group-hover:text-white transition-colors mt-1"><?php echo e($flash->title); ?></p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="text-center pt-2">
                <span class="text-xs text-gray-500 uppercase font-semibold">Flux continu</span>
            </div>
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
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\alisn\Desktop\LARAVEL\projet\resources\views/welcome.blade.php ENDPATH**/ ?>