

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-white">Modifier l'Article</h1>
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-gray-400 hover:text-white transition">
            &larr; Retour au tableau de bord
        </a>
    </div>

    <form action="<?php echo e(route('admin.article.update', $article->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Colonne principale -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-700">
                    <label class="block text-sm font-bold mb-2 text-gray-300 uppercase tracking-wider">Titre de l'article</label>
                    <input type="text" name="title" class="w-full bg-gray-900 border border-gray-700 text-white p-4 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-lg font-semibold placeholder-gray-600" value="<?php echo e(old('title', $article->title)); ?>" required>
                </div>

                <div class="bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-700">
                    <label class="block text-sm font-bold mb-2 text-gray-300 uppercase tracking-wider">Contenu</label>
                    <textarea name="content" rows="15" class="w-full bg-gray-900 border border-gray-700 text-white p-4 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition placeholder-gray-600"><?php echo e(old('content', $article->content)); ?></textarea>
                </div>
            </div>

            <!-- Colonne latérale -->
            <div class="space-y-6">
                <div class="bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-700">
                    <h3 class="font-bold text-white text-lg mb-4 border-b border-gray-700 pb-2">Mise à jour</h3>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2 text-gray-400">Catégorie</label>
                        <select name="category_id" class="w-full bg-gray-900 border border-gray-700 text-white p-3 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cat->id); ?>" <?php echo e($article->category_id == $cat->id ? 'selected' : ''); ?>><?php echo e($cat->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="mb-6">
                         <label class="flex items-center space-x-3 cursor-pointer group">
                            <div class="relative">
                                <input type="checkbox" name="is_headline" class="peer sr-only" <?php echo e($article->is_headline ? 'checked' : ''); ?>>
                                <div class="w-10 h-6 bg-gray-600 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                            </div>
                            <span class="text-sm font-medium text-gray-300 group-hover:text-white transition">Mettre à la une</span>
                        </label>
                    </div>

                    <button type="submit" class="w-full bg-green-600 hover:bg-green-500 text-white font-bold py-3 px-4 rounded-lg transition-colors flex items-center justify-center gap-2">
                        <span>Enregistrer les modifications</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <div class="bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-700">
                    <label class="block text-sm font-bold mb-2 text-gray-300 uppercase tracking-wider">Image de couverture</label>
                    
                    <?php if($article->image): ?>
                        <div class="mb-4 relative group">
                            <img src="<?php echo e(str_starts_with($article->image, 'http') ? $article->image : asset('storage/' . $article->image)); ?>" alt="<?php echo e($article->title); ?>" class="rounded-lg shadow-md w-full">
                            <span class="absolute top-2 left-2 bg-black/50 text-white text-xs font-bold px-2 py-1 rounded">Image actuelle</span>
                        </div>
                        <div class="mb-4">
                            <label class="flex items-center space-x-2 cursor-pointer group">
                                <input type="checkbox" name="delete_image" class="h-4 w-4 rounded border-gray-500 bg-gray-900 text-red-600 focus:ring-red-500">
                                <span class="text-sm font-medium text-red-400 group-hover:text-red-300 transition">Supprimer l'image actuelle</span>
                            </label>
                        </div>
                    <?php endif; ?>
 
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-600 border-dashed rounded-lg hover:border-gray-500 transition-colors">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-400 justify-center">
                                <label for="file-upload" class="relative cursor-pointer bg-gray-800 rounded-md font-medium text-blue-400 hover:text-blue-300 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500 focus-within:ring-offset-gray-800">
                                    <span>Changer l'image</span>
                                    <input id="file-upload" name="image" type="file" class="sr-only">
                                </label>
                            </div>
                            <p class="text-xs text-gray-500">Laisser vide pour conserver l'actuelle</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\alisn\Desktop\LARAVEL\projet\resources\views/admin/edit_article.blade.php ENDPATH**/ ?>