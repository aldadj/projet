

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
<div class="mb-8">
    <h1 class="text-2xl font-bold text-white">
        Résultats pour : <span class="text-blue-400">"<?php echo e($search); ?>"</span>
    </h1>
    <p class="text-gray-400"><?php echo e($articles->count()); ?> article(s) trouvé(s)</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php $__empty_1 = true; $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <a href="<?php echo e(route('article.show', $article->slug)); ?>" class="group relative block w-full h-64 rounded-2xl overflow-hidden shadow-xl">
            <img src="<?php echo e($article->image); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
            
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent opacity-90"></div>

            <div class="absolute bottom-0 left-0 w-full p-4 text-white">
                <span class="inline-block <?php echo e($categoryColors[$article->category->slug] ?? 'bg-gray-600'); ?> text-white text-[10px] font-bold px-2 py-1 rounded-full uppercase mb-2 shadow-sm">
                    <?php echo e($article->category->name); ?>

                </span>

                <h3 class="text-lg font-bold mb-1 leading-tight group-hover:text-red-400 transition-colors line-clamp-2">
                    <?php echo e($article->title); ?>

                </h3>

                <div class="flex items-center text-xs text-gray-400 font-medium">
                    <?php echo e($article->created_at->format('d/m/Y')); ?>

                </div>
            </div>
        </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-span-3 py-20 text-center">
            <p class="text-gray-400 text-xl italic">Désolé, aucun article ne correspond à votre recherche.</p>
            <a href="<?php echo e(route('home')); ?>" class="text-blue-600 underline mt-4 block">Retour à l'accueil</a>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\alisn\Desktop\LARAVEL\projet\resources\views/search.blade.php ENDPATH**/ ?>