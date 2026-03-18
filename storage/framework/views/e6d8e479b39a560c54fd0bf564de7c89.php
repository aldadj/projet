

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-6 py-12">
    
    
    <div class="flex flex-col md:flex-row justify-between items-end mb-12 border-b-8 border-[#212121] pb-8 gap-6">
        <div>
            <div class="flex items-center gap-2 mb-2">
                <span class="w-3 h-3 bg-[#bb1919] animate-pulse"></span>
                <span class="text-[10px] font-black uppercase tracking-[0.3em] text-[#bb1919]">Système de Gestion en Direct</span>
            </div>
            <h1 class="text-6xl font-black text-[#212121] uppercase tracking-tighter leading-none">Tableau de <span class="text-transparent" style="-webkit-text-stroke: 1.5px #212121;">Bord</span></h1>
            <p class="text-gray-500 font-bold text-sm uppercase mt-4 tracking-widest">Contrôle éditorial : ActuPress Bureau</p>
        </div>
        
        <a href="<?php echo e(route('admin.article.create')); ?>" class="bg-[#212121] text-white font-black py-5 px-10 uppercase text-xs tracking-[0.2em] hover:bg-[#bb1919] transition-all shadow-2xl">
            ⊕ Publier un Article
        </a>
    </div>

    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-0 mb-16 border border-gray-200 shadow-sm">
        
        
        <div class="bg-white p-10 border-b md:border-b-0 md:border-r border-gray-200 group">
            <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-4 group-hover:text-[#bb1919] transition-colors">Total Publications</p>
            <div class="flex items-baseline gap-2">
                <p class="text-6xl font-black text-[#212121] tracking-tighter"><?php echo e($count_articles ?? 0); ?></p>
                <span class="text-xs font-bold text-gray-400">Articles</span>
            </div>
        </div>

        
        <div class="bg-[#f8f8f8] p-10 border-b md:border-b-0 md:border-r border-gray-200 group">
            <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-4 group-hover:text-blue-600 transition-colors">Boîte de Réception</p>
            <div class="flex items-baseline gap-4">
                <p class="text-6xl font-black text-[#212121] tracking-tighter"><?php echo e($unread_messages ?? 0); ?></p>
                <span class="bg-blue-600 text-white text-[10px] px-2 py-1 font-black uppercase tracking-tighter">Non lus</span>
            </div>
        </div>

        
        <div class="bg-[#212121] p-10 group relative overflow-hidden min-h-[180px] flex flex-col justify-center">
            <div class="relative z-10">
                <p class="text-[10px] font-black uppercase tracking-widest text-[#bb1919] mb-4">Configuration Site</p>
                <h3 class="text-white font-black text-xl uppercase tracking-tighter mb-6 leading-tight">Gérer la page<br>Qui Sommes-Nous</h3>
                <a href="<?php echo e(route('admin.qsn.edit')); ?>" class="inline-block text-[10px] font-black uppercase tracking-widest text-white border-b-2 border-[#bb1919] pb-1 hover:text-[#bb1919] transition-all">
                    Accéder aux réglages →
                </a>
            </div>
            
            <span class="absolute -right-4 -bottom-4 text-white opacity-5 text-8xl font-black italic select-none">GEAR</span>
        </div>
    </div>

    
    <div class="mb-20">
        <div class="flex items-center gap-4 mb-8">
            <h2 class="text-2xl font-black uppercase tracking-tighter text-[#212121]">Archives des Articles</h2>
            <div class="h-1 flex-grow bg-gray-100"></div>
        </div>
        <div class="bg-white border border-gray-200 p-2">
             <?php echo $__env->make('components.article_list', ['articles' => $articles], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>
    
    <div class="border-t-4 border-[#212121] pt-12">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-black uppercase tracking-tighter text-[#212121]">Correspondance Lecteurs</h2>
        </div>

        <div class="bg-white border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-[#212121] text-white text-[10px] uppercase font-black tracking-widest">
                            <th class="px-8 py-5">Source</th>
                            <th class="px-8 py-5">Sujet</th>
                            <th class="px-8 py-5 text-center">Date</th>
                            <th class="px-8 py-5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50 transition-colors group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-3">
                                        
                                        <?php if(!$message->is_read): ?>
                                            <span class="relative flex h-2 w-2">
                                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#bb1919] opacity-75"></span>
                                                <span class="relative inline-flex rounded-full h-2 w-2 bg-[#bb1919]"></span>
                                            </span>
                                        <?php else: ?>
                                            
                                            <span class="h-2 w-2 rounded-full bg-gray-200"></span>
                                        <?php endif; ?>
                                        
                                        <span class="text-sm font-black text-[#212121] uppercase tracking-tighter <?php echo e(!$message->is_read ? 'text-[#bb1919]' : ''); ?>">
                                            <?php echo e($message->name); ?>

                                        </span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-sm <?php echo e(!$message->is_read ? 'font-black text-[#212121]' : 'font-bold text-gray-500'); ?> italic">
                                    "<?php echo e(Str::limit($message->subject, 50)); ?>"
                                </td>
                                <td class="px-8 py-6 text-center text-[10px] font-black text-gray-400">
                                    <?php echo e($message->created_at->format('d/m/Y')); ?>

                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="<?php echo e(route('admin.message.show', $message->id)); ?>" class="bg-gray-100 text-[#212121] text-[10px] font-black py-2 px-4 uppercase tracking-widest hover:bg-[#212121] hover:text-white transition-all shadow-sm">
                                            Ouvrir
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="4" class="py-10 text-center text-gray-400 uppercase text-[10px] font-black">Aucun message</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\alisn\Desktop\LARAVEL\projet\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>