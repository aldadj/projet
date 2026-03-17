

<?php $__env->startSection('content'); ?>
<div class="relative bg-white py-12">
    
    <div class="absolute inset-0 z-0">
        <div class="absolute top-0 left-0 w-full h-64 bg-gradient-to-b from-blue-50 to-white"></div>
    </div>

    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex justify-between items-center">
            <span class="text-blue-600 font-bold uppercase tracking-widest text-sm bg-blue-50 px-3 py-1 rounded-full">Notre Histoire</span>
            <a href="<?php echo e(route('home')); ?>" class="text-gray-500 hover:text-blue-600 transition font-medium text-sm flex items-center gap-1">&larr; Retour à l'accueil</a>
        </div>

        <div class="text-center mb-12">
            <h1 class="text-4xl font-black text-slate-900 tracking-tight sm:text-6xl mb-6">
                Qui Sommes-Nous ?
            </h1>
            <p class="max-w-2xl mx-auto text-xl text-slate-500 font-light leading-relaxed">
                Découvrez l'équipe et la mission derrière ACTUPRESS.
            </p>
        </div>
        
        <div class="bg-white p-10 sm:p-14 shadow-2xl shadow-blue-900/5 rounded-3xl border border-slate-100 prose prose-lg prose-slate max-w-none text-slate-600 leading-relaxed">
            <?php echo nl2br(e($qsn->value ?? 'Contenu en cours de rédaction...')); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\alisn\Desktop\LARAVEL\projet\resources\views/qsn.blade.php ENDPATH**/ ?>