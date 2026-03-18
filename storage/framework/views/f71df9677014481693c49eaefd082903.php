

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto px-6 py-12">
    
    
    <div class="mb-8">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="group flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 hover:text-[#bb1919] transition-colors">
            <span class="text-lg group-hover:-translate-x-1 transition-transform">←</span> 
            Retour au Bureau d'Édition
        </a>
    </div>

    <div class="bg-white border border-gray-200 shadow-[0_30px_60px_-15px_rgba(0,0,0,0.1)] overflow-hidden">
        
        <div class="bg-[#212121] p-8 text-white flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-black uppercase tracking-tighter">Nouvelle <span class="text-[#bb1919]">Publication</span></h1>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.3em] mt-1">Rédaction ActuPress / Terminal 01</p>
            </div>
            <span class="w-12 h-12 bg-[#bb1919] flex items-center justify-center font-black text-2xl">⊕</span>
        </div>

        
        <?php if($errors->any()): ?>
            <div class="bg-[#bb1919] text-white p-6 font-bold text-sm uppercase tracking-wide">
                <div class="flex items-center gap-3 mb-2">
                    <span class="text-2xl">⚠️</span>
                    <span>Erreurs de transmission détectées :</span>
                </div>
                <ul class="list-disc list-inside text-[11px] opacity-90 font-medium">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('admin.article.store')); ?>" method="POST" enctype="multipart/form-data" class="p-10 space-y-8">
            <?php echo csrf_field(); ?>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <div class="md:col-span-2 group">
                    <label for="title" class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 group-focus-within:text-[#bb1919] transition-colors">Titre de l'article</label>
                    <input type="text" id="title" name="title" value="<?php echo e(old('title')); ?>" 
                           class="w-full bg-gray-50 border-b-2 border-gray-200 p-4 text-xl font-black text-[#212121] focus:outline-none focus:border-[#bb1919] focus:bg-white transition-all placeholder:text-gray-200" 
                           placeholder="EX: L'IMPACT DU NUMÉRIQUE À OUAGADOUGOU..." required>
                </div>

                
                <div class="group">
                    <label for="category_id" class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 group-focus-within:text-[#bb1919] transition-colors">Section / Catégorie</label>
                    <select id="category_id" name="category_id" 
                            class="w-full bg-gray-50 border-b-2 border-gray-200 p-3 text-sm font-bold text-[#212121] focus:outline-none focus:border-[#bb1919] transition-all cursor-pointer" required>
                        <option value="">-- Sélectionner --</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id') == $category->id ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                
                <div class="group">
                    <label for="image" class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 group-focus-within:text-[#bb1919] transition-colors">Document Visuel (Image)</label>
                    <input type="file" id="image" name="image" 
                           class="w-full text-[10px] text-gray-400 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-[#212121] file:text-white hover:file:bg-[#bb1919] cursor-pointer transition-all">
                </div>
            </div>

            
            <div id="preview-container" class="hidden border-4 border-double border-gray-100 p-2">
                <p class="text-[10px] font-black uppercase tracking-widest text-gray-300 mb-2 text-center">Aperçu du visuel</p>
                <img id="image-preview" src="#" class="max-h-64 w-full object-cover grayscale hover:grayscale-0 transition-all duration-500">
            </div>

            
            <div class="group">
                <label for="content" class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 group-focus-within:text-[#bb1919] transition-colors">Corps du sujet (Rédaction)</label>
                <textarea id="content" name="content" rows="12" 
                          class="w-full bg-gray-50 border-2 border-gray-100 p-5 text-sm font-medium leading-relaxed text-[#212121] focus:outline-none focus:border-[#bb1919] focus:bg-white transition-all resize-none" 
                          placeholder="Écrivez votre article ici..." required><?php echo e(old('content')); ?></textarea>
            </div>

            
            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-[#212121] text-white font-black py-5 px-12 uppercase text-xs tracking-[0.3em] hover:bg-[#bb1919] transition-all shadow-xl active:scale-[0.98]">
                    Diffuser l'article →
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('image').onchange = evt => {
        const [file] = document.getElementById('image').files
        if (file) {
            document.getElementById('preview-container').classList.remove('hidden');
            document.getElementById('image-preview').src = URL.createObjectURL(file)
        }
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\alisn\Desktop\LARAVEL\projet\resources\views/admin/create_article.blade.php ENDPATH**/ ?>