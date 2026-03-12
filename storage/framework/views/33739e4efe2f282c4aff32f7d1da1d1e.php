

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-white">Modifier la page "Qui Sommes-Nous"</h1>
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-gray-400 hover:text-white transition">
            &larr; Retour au tableau de bord
        </a>
    </div>

    <div class="bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-700">
        <form action="<?php echo e(route('admin.qsn.update')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-6">
                <label class="block text-sm font-bold mb-2 text-gray-300 uppercase tracking-wider">Contenu de la page</label>
                <textarea name="value" rows="15" class="w-full bg-gray-900 border border-gray-700 text-white p-4 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition placeholder-gray-600"><?php echo e(old('value', $qsn->value)); ?></textarea>
            </div>
            <button type="submit" class="bg-green-600 hover:bg-green-500 text-white font-bold py-3 px-6 rounded-lg transition-colors flex items-center justify-center gap-2">
                <span>Enregistrer les modifications</span>
            </button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\alisn\Desktop\LARAVEL\projet\resources\views/admin/edit_qsn.blade.php ENDPATH**/ ?>