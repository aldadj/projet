

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">
    
    <div class="flex justify-between items-center mb-8">
        <div class="flex items-center gap-4">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="p-2 bg-slate-800 rounded-full text-slate-400 hover:text-white hover:bg-slate-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" /></svg>
            </a>
            <h1 class="text-2xl font-bold text-white tracking-tight">Lecture du message</h1>
        </div>
        <div class="flex gap-3">
            <a href="mailto:<?php echo e($message->email); ?>?subject=Re: <?php echo e($message->subject); ?>" class="flex items-center gap-2 bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg font-bold text-sm transition shadow-lg shadow-blue-900/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" /><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" /></svg>
                Répondre
            </a>
            <form action="<?php echo e(route('admin.message.delete', $message->id)); ?>" method="POST" onsubmit="return confirm('Supprimer ce message définitivement ?');">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button type="submit" class="flex items-center gap-2 bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white px-4 py-2 rounded-lg font-bold text-sm transition border border-red-500/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                    Supprimer
                </button>
            </form>
        </div>
    </div>

    <div class="bg-slate-800 rounded-2xl shadow-xl border border-slate-700 overflow-hidden">
        
        <div class="p-8 border-b border-slate-700 bg-slate-900/30 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold text-lg shadow-lg">
                        <?php echo e(substr($message->name, 0, 1)); ?>

                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white leading-none"><?php echo e($message->name); ?></h2>
                        <a href="mailto:<?php echo e($message->email); ?>" class="text-blue-400 hover:text-blue-300 text-sm font-medium transition-colors">
                            <?php echo e($message->email); ?>

                        </a>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-2 text-slate-400 text-sm bg-slate-700/30 px-4 py-2 rounded-full border border-slate-700/50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" /></svg>
                <?php echo e($message->created_at->format('d M Y à H:i')); ?>

            </div>
        </div>
        
        
        <div class="p-8 md:p-10">
            <div class="mb-8">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider block mb-2">Objet du message</span>
                <h3 class="text-xl md:text-2xl font-bold text-white leading-tight">
                    <?php echo e($message->subject); ?>

                </h3>
            </div>
            
            <div class="prose prose-invert max-w-none text-slate-300 leading-relaxed bg-slate-900/50 p-6 rounded-xl border border-slate-700/50 shadow-inner">
                <?php echo nl2br(e($message->message)); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\alisn\Desktop\LARAVEL\projet\resources\views/admin/show_message.blade.php ENDPATH**/ ?>