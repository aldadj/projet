

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border border-slate-100 flex flex-col md:flex-row">
        
        
        <div class="bg-slate-900 text-white p-10 md:w-1/3 flex flex-col justify-between">
            <div>
                <h2 class="text-2xl font-bold mb-6 tracking-wide">Contactez-nous</h2>
                <p class="text-slate-300 text-sm leading-relaxed mb-8">
                    Une question sur un article ? Une suggestion pour notre équipe ? N'hésitez pas à nous laisser un message.
                </p>
                
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <span class="bg-blue-600 p-2 rounded-lg"><svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></span>
                        <span class="text-sm font-medium">alisnybelem@gmail.com</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="bg-blue-600 p-2 rounded-lg"><svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg></span>
                        <span class="text-sm font-medium">+226 76 22 86 22</span>
                    </div>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-slate-700">
                <p class="text-xs text-slate-400">&copy; ActuPress - Tous droits réservés.</p>
            </div>
        </div>

        
        <div class="p-10 md:w-2/3 bg-white">
            <?php if(session('success')): ?>
                <div class="bg-green-50 text-green-700 p-4 rounded-lg mb-6 text-sm border-l-4 border-green-500">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
            
            <form action="<?php echo e(route('contact.store')); ?>" method="POST" class="space-y-5">
                <?php echo csrf_field(); ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nom complet</label>
                        <input type="text" name="name" class="w-full border-b-2 border-gray-200 bg-transparent py-2 px-1 focus:border-blue-600 focus:outline-none transition-colors" placeholder="Votre nom" required>
                    </div>
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Email</label>
                        <input type="email" name="email" class="w-full border-b-2 border-gray-200 bg-transparent py-2 px-1 focus:border-blue-600 focus:outline-none transition-colors" placeholder="votre@email.com" required>
                    </div>
                </div>
                <div class="group">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Sujet</label>
                    <input type="text" name="subject" class="w-full border-b-2 border-gray-200 bg-transparent py-2 px-1 focus:border-blue-600 focus:outline-none transition-colors" placeholder="De quoi s'agit-il ?" required>
                </div>
                <div class="group">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Message</label>
                    <textarea name="message" rows="4" class="w-full border-2 border-gray-100 bg-gray-50 rounded-lg p-3 focus:border-blue-600 focus:bg-white focus:outline-none transition-all resize-none" placeholder="Votre message..." required></textarea>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-4 rounded-lg hover:bg-blue-700 transition transform hover:-translate-y-1 shadow-lg">
                    Envoyer le message
                </button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\alisn\Desktop\LARAVEL\projet\resources\views/contact.blade.php ENDPATH**/ ?>