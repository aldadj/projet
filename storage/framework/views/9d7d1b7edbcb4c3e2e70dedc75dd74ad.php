

<?php $__env->startSection('content'); ?>
<div class="max-w-5xl mx-auto px-4 py-8">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
        <div class="flex items-center gap-6">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="group flex items-center justify-center w-12 h-12 bg-white border-2 border-slate-200 rounded-full text-slate-600 hover:border-[#bb1919] hover:text-[#bb1919] transition-all shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tighter uppercase italic">Boîte de réception</h1>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Gestion des contacts lecteurs</p>
            </div>
        </div>

        <div class="flex gap-4 w-full md:w-auto">
            <a href="mailto:<?php echo e($message->email); ?>?subject=Re: <?php echo e($message->subject); ?>" class="flex-1 md:flex-none flex items-center justify-center gap-3 bg-[#212121] hover:bg-[#bb1919] text-white px-6 py-3 font-black text-xs uppercase tracking-widest transition-all shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                </svg>
                Répondre
            </a>
            <form action="<?php echo e(route('admin.message.delete', $message->id)); ?>" method="POST" onsubmit="return confirm('Supprimer définitivement ?');" class="flex-1 md:flex-none">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button type="submit" class="w-full flex items-center justify-center gap-3 bg-white hover:bg-red-50 text-red-600 px-6 py-3 font-black text-xs uppercase tracking-widest transition-all border-2 border-red-600 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Supprimer
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white border-t-4 border-[#bb1919] shadow-2xl overflow-hidden">
        
        <div class="p-8 border-b border-slate-100 bg-slate-50/50 flex flex-col md:flex-row justify-between items-start gap-8">
            <div class="flex items-start gap-5">
                <div class="h-16 w-16 bg-[#212121] flex items-center justify-center text-[#bb1919] font-black text-2xl border-b-4 border-[#bb1919]">
                    <?php echo e(substr($message->name, 0, 1)); ?>

                </div>
                <div>
                    <h2 class="text-2xl font-black text-slate-900 leading-none uppercase tracking-tighter"><?php echo e($message->name); ?></h2>
                    <div class="mt-2 flex flex-col gap-1">
                        <a href="mailto:<?php echo e($message->email); ?>" class="text-[#bb1919] hover:underline text-sm font-bold tracking-tight italic">
                            <?php echo e($message->email); ?>

                        </a>
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Reçu le <?php echo e($message->created_at->format('d/m/Y')); ?> à <?php echo e($message->created_at->format('H:i')); ?>

                        </span>
                    </div>
                </div>
            </div>
            
            
            <div class="bg-green-100 text-green-700 px-4 py-1 text-[10px] font-black uppercase tracking-[0.2em] self-start md:self-center">
                Message Lu
            </div>
        </div>
        
        
        <div class="p-8 md:p-12">
            <div class="mb-10">
                <span class="text-[10px] font-black text-[#bb1919] uppercase tracking-[0.3em] block mb-3">Sujet de la correspondance —</span>
                <h3 class="text-3xl md:text-4xl font-black text-slate-900 leading-[0.9] uppercase tracking-tighter italic">
                    <?php echo e($message->subject); ?>

                </h3>
            </div>
            
            <div class="relative">
                
                <div class="absolute -top-6 -left-4 text-slate-100 text-8xl font-black select-none z-0">“</div>
                
                <div class="relative z-10 text-slate-700 text-lg leading-relaxed font-medium bg-white p-2">
                    <?php echo nl2br(e($message->message)); ?>

                </div>
            </div>
        </div>

        
        <div class="px-8 py-6 bg-slate-900 flex justify-between items-center">
            <span class="text-[9px] font-black text-slate-500 uppercase tracking-[0.4em]">Fin du message</span>
            <div class="flex gap-2">
                <div class="w-2 h-2 bg-[#bb1919]"></div>
                <div class="w-2 h-2 bg-white"></div>
                <div class="w-2 h-2 bg-slate-700"></div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\alisn\Desktop\LARAVEL\projet\resources\views/admin/show_message.blade.php ENDPATH**/ ?>