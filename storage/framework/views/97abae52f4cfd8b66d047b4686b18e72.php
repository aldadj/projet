

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto bg-slate-800 p-8 shadow-xl rounded-2xl border border-slate-700">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-white uppercase border-b-4 border-blue-500 inline-block pb-2">Nous contacter</h1>
        <a href="<?php echo e(route('home')); ?>" class="text-gray-400 hover:text-white transition inline-flex items-center gap-2">
            &larr; Retour à l'accueil
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="bg-green-900/50 border border-green-500 text-green-300 px-4 py-3 rounded-lg mb-6 text-center">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('contact.store')); ?>" method="POST" class="space-y-6">
        <?php echo csrf_field(); ?>
        <div>
            <label class="block text-sm font-bold mb-2 text-slate-400 uppercase tracking-wider">Nom complet</label>
            <input type="text" name="name" class="w-full bg-slate-900 border border-slate-700 p-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" required>
        </div>

        <div>
            <label class="block text-sm font-bold mb-2 text-slate-400 uppercase tracking-wider">Email</label>
            <input type="email" name="email" class="w-full bg-slate-900 border border-slate-700 p-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" required>
        </div>

        <div>
            <label class="block text-sm font-bold mb-2 text-slate-400 uppercase tracking-wider">Sujet</label>
            <input type="text" name="subject" class="w-full bg-slate-900 border border-slate-700 p-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" required>
        </div>

        <div>
            <label class="block text-sm font-bold mb-2 text-slate-400 uppercase tracking-wider">Message</label>
            <textarea name="message" rows="5" class="w-full bg-slate-900 border border-slate-700 p-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" required></textarea>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-8 rounded-full hover:bg-blue-500 transition-all transform hover:scale-105 shadow-lg uppercase tracking-wider">
            Envoyer le message
        </button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\alisn\Desktop\LARAVEL\projet\resources\views/contact.blade.php ENDPATH**/ ?>