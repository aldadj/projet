

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto px-4 py-12">
    
    
    <div class="border-b-4 border-[#212121] mb-12 pb-4">
        <h1 class="text-5xl font-black uppercase tracking-tighter text-[#212121]">Contactez <span class="text-[#bb1919]">ActuPress</span></h1>
        <p class="text-gray-500 font-bold text-sm uppercase mt-2 tracking-[0.2em]">Service auditeurs et lecteurs</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-0 bg-white shadow-sm border border-gray-200">
        
        
        <div class="lg:col-span-4 bg-[#212121] text-white p-10 flex flex-col justify-between">
            <div>
                <h2 class="text-2xl font-black mb-8 border-l-4 border-[#bb1919] pl-4 uppercase tracking-tight">Nos Bureaux</h2>
                
                <div class="space-y-10">
                    <div>
                        <p class="text-[10px] font-black uppercase text-gray-500 tracking-widest mb-2">Siège Social</p>
                        <p class="text-sm font-bold leading-relaxed">
                            Avenue de la Nation<br>
                            Ouagadougou, Burkina Faso<br>
                            Immeuble Aldadj Tech
                        </p>
                    </div>

                    <div class="space-y-6">
                        <div class="flex flex-col">
                            <span class="text-[10px] font-black uppercase text-gray-500 tracking-widest mb-1">Email</span>
                            <a href="mailto:alisnybelem@gmail.com" class="text-lg font-bold hover:text-[#bb1919] transition-colors">alisnybelem@gmail.com</a>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[10px] font-black uppercase text-gray-500 tracking-widest mb-1">Téléphone</span>
                            <span class="text-lg font-bold">+226 76 22 86 22</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-white/10">
                <div class="flex gap-4">
                    <span class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-xs font-bold">FB</span>
                    <span class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-xs font-bold">TW</span>
                    <span class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-xs font-bold">YT</span>
                </div>
            </div>
        </div>

        
        <div class="lg:col-span-8 p-10 bg-white">
            <?php if(session('success')): ?>
                <div class="bg-[#e7f3f5] border-l-4 border-[#1380a1] text-[#1380a1] p-6 mb-8 font-bold">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <span><?php echo e(session('success')); ?></span>
                    </div>
                </div>
            <?php endif; ?>
            
            <form action="<?php echo e(route('contact.store')); ?>" method="POST" class="space-y-8">
                <?php echo csrf_field(); ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="flex flex-col gap-2">
                        <label class="text-xs font-black uppercase tracking-tighter text-[#212121]">Nom complet</label>
                        <input type="text" name="name" 
                               class="bg-[#f2f2f2] border-b-2 border-transparent p-4 focus:border-[#bb1919] focus:outline-none font-bold text-sm transition-all" 
                               placeholder="Ex: Belem Ali" required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-xs font-black uppercase tracking-tighter text-[#212121]">Adresse Email</label>
                        <input type="email" name="email" 
                               class="bg-[#f2f2f2] border-b-2 border-transparent p-4 focus:border-[#bb1919] focus:outline-none font-bold text-sm transition-all" 
                               placeholder="votre@email.com" required>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-xs font-black uppercase tracking-tighter text-[#212121]">Sujet du message</label>
                    <input type="text" name="subject" 
                           class="bg-[#f2f2f2] border-b-2 border-transparent p-4 focus:border-[#bb1919] focus:outline-none font-bold text-sm transition-all" 
                           placeholder="Ex: Suggestion d'article" required>
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-xs font-black uppercase tracking-tighter text-[#212121]">Votre Message</label>
                    <textarea name="message" rows="6" 
                              class="bg-[#f2f2f2] border-b-2 border-transparent p-4 focus:border-[#bb1919] focus:outline-none font-bold text-sm transition-all resize-none" 
                              placeholder="Comment pouvons-nous vous aider ?" required></textarea>
                </div>

                <div class="pt-4">
                    <button type="submit" 
                            class="bg-[#bb1919] text-white px-10 py-4 font-black uppercase text-xs tracking-[0.2em] hover:bg-[#212121] transition-all transform active:scale-95 shadow-lg">
                        Envoyer le message
                    </button>
                    <p class="text-[10px] text-gray-400 mt-4 font-bold uppercase tracking-tighter">
                        En envoyant ce formulaire, vous acceptez que vos données soient traitées conformément à notre politique de confidentialité.
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\alisn\Desktop\LARAVEL\projet\resources\views/contact.blade.php ENDPATH**/ ?>