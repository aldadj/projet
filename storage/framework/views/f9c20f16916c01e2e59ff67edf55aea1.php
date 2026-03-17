

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

<div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <div>
        <h1 class="text-3xl font-bold text-slate-900 uppercase border-b-4 border-blue-500 inline-block pb-2">
            <?php echo e($category->name); ?>

        </h1>
        <p class="text-slate-600 mt-2">Les derniers articles de la section <?php echo e($category->name); ?>.</p>
    </div>
    <a href="<?php echo e(route('home')); ?>" class="text-slate-500 hover:text-slate-900 transition inline-flex items-center gap-2">
        &larr; Retour à l'accueil
    </a>
</div>

<div class="grid grid-cols-2 md:grid-cols-3 gap-6">
    <?php $__empty_1 = true; $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <a href="<?php echo e(route('article.show', $article->slug)); ?>" class="group bg-gray-800/70 hover:bg-gray-800 transition-colors rounded-2xl shadow-lg overflow-hidden flex flex-col border border-gray-700/50 hover:border-blue-500/50">
            <?php if($article->image): ?>
                <div class="h-48 overflow-hidden">
                    <img src="<?php echo e(str_starts_with($article->image, 'http') ? $article->image : asset('storage/' . $article->image)); ?>" alt="<?php echo e($article->title); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                </div>
            <?php endif; ?>
            <div class="p-4 flex flex-col flex-grow">
                
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
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-span-3 py-10 text-center text-gray-400 italic">
            Aucun article pour le moment dans cette catégorie.
        </div>
    <?php endif; ?>
</div>

<div class="mt-10">
    <?php echo e($articles->links()); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\alisn\Desktop\LARAVEL\projet\resources\views/category.blade.php ENDPATH**/ ?>