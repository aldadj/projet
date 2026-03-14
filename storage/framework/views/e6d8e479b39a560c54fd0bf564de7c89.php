

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto space-y-8">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-white">Tableau de Bord</h1>
            <p class="text-gray-400">Gérez vos articles et consultez vos messages.</p>
        </div>
        <a href="<?php echo e(route('admin.article.create')); ?>" class="flex items-center gap-2 bg-blue-600 hover:bg-blue-500 text-white px-6 py-3 rounded-xl shadow-lg shadow-blue-600/20 transition-all hover:scale-105 font-bold">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
            </svg>
            Nouvel Article
        </a>
    </div>

    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-gray-800 p-6 rounded-2xl shadow-xl border border-gray-700 flex items-center justify-between group hover:border-blue-500 transition-colors">
            <div>
                <p class="text-gray-400 text-sm font-medium uppercase tracking-wider mb-1">Total Articles</p>
                <p class="text-4xl font-bold text-white"><?php echo e($count_articles); ?></p>
            </div>
            <div class="h-12 w-12 bg-blue-500/10 rounded-full flex items-center justify-center text-blue-400 group-hover:bg-blue-500 group-hover:text-white transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
            </div>
        </div>

        <div class="bg-gray-800 p-6 rounded-2xl shadow-xl border border-gray-700 flex items-center justify-between group hover:border-green-500 transition-colors">
            <div>
                <p class="text-gray-400 text-sm font-medium uppercase tracking-wider mb-1">Messages Non Lus</p>
                <p class="text-4xl font-bold text-white"><?php echo e($unread_messages); ?></p>
            </div>
            <div class="h-12 w-12 bg-green-500/10 rounded-full flex items-center justify-center text-green-400 group-hover:bg-green-500 group-hover:text-white transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
        </div>

        <div class="bg-gray-800 p-6 rounded-2xl shadow-xl border border-gray-700 flex flex-col justify-between group hover:border-purple-500 transition-colors relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-gray-400 text-sm font-medium uppercase tracking-wider mb-2">Configuration</p>
                <a href="<?php echo e(route('admin.qsn.edit')); ?>" class="inline-flex items-center text-purple-400 hover:text-purple-300 font-bold transition-colors">
                    Modifier la page QSN
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
            <div class="absolute -bottom-4 -right-4 text-gray-700/20 group-hover:text-purple-500/10 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
        </div>
    </div>

    
    <div class="bg-gray-800 rounded-2xl shadow-xl border border-gray-700 overflow-hidden">
        <div class="p-6 border-b border-gray-700">
            <h2 class="text-xl font-bold text-white">Gestion des Articles</h2>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 p-6">
            <?php $__empty_1 = true; $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="group bg-gray-900 rounded-xl border border-gray-700 overflow-hidden hover:border-gray-500 transition-all shadow-lg hover:shadow-2xl flex flex-col">
                    <div class="h-40 overflow-hidden relative">
                         <?php if($article->image): ?>
                            <img src="<?php echo e(str_starts_with($article->image, 'http') ? $article->image : asset($article->image)); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                       <?php else: ?>
                            <div class="w-full h-full bg-gray-800 flex items-center justify-center text-gray-600 font-bold">Sans Image</div>
                         <?php endif; ?>
                         
                         <?php if($article->is_headline): ?>
                            <span class="absolute top-2 left-2 bg-red-600 text-white text-[10px] font-bold px-2 py-0.5 rounded-full uppercase shadow-sm">À la une</span>
                         <?php endif; ?>
                    </div>

                    <div class="p-4 flex-1 flex flex-col">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-blue-400 text-xs font-bold uppercase tracking-wide"><?php echo e($article->category->name); ?></span>
                            <span class="text-xs text-gray-500"><?php echo e($article->created_at->format('d/m/Y')); ?></span>
                        </div>
                        <h3 class="font-bold text-white mb-4 line-clamp-2 flex-1"><?php echo e($article->title); ?></h3>
                        
                        <div class="flex items-center gap-2 mt-auto pt-4 border-t border-gray-800">
                            <a href="<?php echo e(route('admin.article.edit', $article->id)); ?>" class="flex-1 bg-gray-700 hover:bg-gray-600 text-white text-center py-2 rounded-lg text-sm font-bold transition-colors">Modifier</a>
                            
                            <form action="<?php echo e(route('admin.article.delete', $article->id)); ?>" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="bg-red-500/20 hover:bg-red-500 text-red-400 hover:text-white p-2 rounded-lg transition-colors" title="Supprimer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-full py-12 text-center">
                    <div class="inline-block p-4 rounded-full bg-gray-700 text-gray-500 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <p class="text-gray-400 text-lg">Aucun article publié pour le moment.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="bg-gray-800 rounded-2xl shadow-xl border border-gray-700 overflow-hidden">
        <div class="p-6 border-b border-gray-700">
            <h2 class="text-xl font-bold text-white">Derniers Messages Reçus</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-gray-300">
                <thead class="bg-gray-900/50 text-gray-400 uppercase text-xs font-bold tracking-wider">
                    <tr>
                        <th class="p-4">Nom</th>
                        <th class="p-4">Sujet</th>
                        <th class="p-4">Date</th>
                        <th class="p-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-gray-700/50 transition-colors">
                        <td class="p-4 font-medium text-white"><?php echo e($msg->name); ?></td>
                        <td class="p-4"><?php echo e($msg->subject); ?></td>
                        <td class="p-4 text-sm text-gray-400"><?php echo e($msg->created_at->format('d/m H:i')); ?></td>
                        <td class="p-4 text-right">
                            <a href="<?php echo e(route('admin.message.show', $msg->id)); ?>" class="text-blue-400 hover:text-white font-bold text-sm transition-colors">Lire</a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="p-8 text-center text-gray-500 italic">Aucun message reçu.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\alisn\Desktop\LARAVEL\projet\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>