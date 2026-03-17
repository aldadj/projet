<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Site de Presse</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-200 antialiased font-sans">
    <nav class="bg-slate-800/90 backdrop-blur-md sticky top-0 z-50 border-b border-slate-700 shadow-lg mb-8">
        <div class="container mx-auto px-4 h-20 flex items-center justify-between">
            
            
            <div class="flex items-center gap-10">
                <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-2 group">
                    <span class="text-3xl">📰</span>
                    <span class="text-2xl font-bold text-white tracking-tight group-hover:text-blue-400 transition-colors">ACTU<span class="text-blue-500">PRESS</span></span>
                </a>
                
                <div class="hidden md:flex items-center gap-6">
                    <a href="<?php echo e(route('home')); ?>" class="text-sm font-bold uppercase tracking-wider transition-colors <?php echo e(request()->routeIs('home') && !request('search') ? 'text-blue-400' : 'text-gray-400 hover:text-white'); ?>">
                        Accueil
                    </a>

                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('category.show', $category->slug)); ?>" 
                           class="text-sm font-bold uppercase tracking-wider transition-colors <?php echo e(request()->is('categorie/'.$category->slug) ? 'text-blue-400' : 'text-gray-400 hover:text-white'); ?>">
                            <?php echo e($category->name); ?>

                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <a href="<?php echo e(route('qsn')); ?>" class="text-sm font-bold uppercase tracking-wider transition-colors <?php echo e(request()->routeIs('qsn') ? 'text-blue-400' : 'text-gray-400 hover:text-white'); ?>">
                        QSN
                    </a>
                    <a href="<?php echo e(route('contact')); ?>" class="text-sm font-bold uppercase tracking-wider transition-colors <?php echo e(request()->routeIs('contact') ? 'text-blue-400' : 'text-gray-400 hover:text-white'); ?>">
                        Contact
                    </a>
                </div>
            </div>

            
            <form action="<?php echo e(route('home')); ?>" method="GET" class="hidden md:flex items-center relative group">
                <input type="text" name="search" placeholder="Rechercher..." 
                       class="bg-slate-900 border border-slate-600 text-slate-200 text-sm rounded-full pl-5 pr-10 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 w-64 transition-all"
                       value="<?php echo e(request('search')); ?>">
                <button type="submit" class="absolute right-3 text-slate-400 hover:text-white transition-colors">
                    🔍
                </button>
            </form>

            
            <button id="mobile-menu-btn" class="md:hidden text-gray-300 hover:text-white focus:outline-none p-2">
                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        
        <div id="mobile-menu" class="md:hidden bg-slate-800 border-t border-slate-700 absolute w-full left-0 top-20 shadow-xl z-50 transition-all duration-300 ease-in-out transform opacity-0 -translate-y-5 pointer-events-none">
            <div class="flex flex-col p-4 space-y-4">
                <form action="<?php echo e(route('home')); ?>" method="GET" class="relative">
                    <input type="text" name="search" placeholder="Rechercher..." class="w-full bg-slate-900 border border-slate-600 text-slate-200 text-sm rounded-lg pl-4 pr-10 py-3 focus:outline-none focus:border-blue-500" value="<?php echo e(request('search')); ?>">
                    <button type="submit" class="absolute right-3 top-3 text-slate-400">🔍</button>
                </form>

                <a href="<?php echo e(route('home')); ?>" class="block text-slate-300 hover:text-white font-bold uppercase py-2 border-b border-slate-700">Accueil</a>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('category.show', $category->slug)); ?>" class="block text-slate-300 hover:text-white font-bold uppercase py-2 border-b border-slate-700 pl-4 border-l-4 border-transparent hover:border-blue-500">
                        <?php echo e($category->name); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('qsn')); ?>" class="block text-slate-300 hover:text-white font-bold uppercase py-2 border-b border-slate-700">QSN</a>
                <a href="<?php echo e(route('contact')); ?>" class="block text-slate-300 hover:text-white font-bold uppercase py-2">Contact</a>
            </div>
        </div>
    </nav>

    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('opacity-0');
            menu.classList.toggle('-translate-y-5');
            menu.classList.toggle('pointer-events-none');
        });
    </script>

    <main class="container mx-auto px-4 min-h-screen py-6">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="bg-slate-950 border-t border-slate-800 mt-16 py-10 text-slate-500 text-sm">
    <div class="container mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="text-center md:text-left">
            <span class="block text-lg font-bold text-slate-300 mb-1">ACTU<span class="text-blue-500">PRESS</span></span>
            <p>&copy; <?php echo e(date('Y')); ?> - L'information en temps - ALDADJ TECH conception.</p>
        </div>
        
        <div class="flex items-center gap-6">
            <?php if(auth()->guard()->guest()): ?>
                <a href="<?php echo e(route('login')); ?>" class="hover:text-blue-400 transition-colors">Espace Admin</a>
            <?php endif; ?>

            <?php if(auth()->guard()->check()): ?>
                <div class="flex gap-4 items-center bg-slate-900 px-4 py-2 rounded-full border border-slate-700">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-blue-400 font-bold hover:text-blue-300 text-xs uppercase">Dashboard</a>
                    <span class="text-slate-700">|</span>
                    <form action="<?php echo e(route('logout')); ?>" method="POST" class="inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="text-red-500 hover:text-red-400 text-xs font-bold uppercase">Déconnexion</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
</footer>

</body>
</html><?php /**PATH C:\Users\alisn\Desktop\LARAVEL\projet\resources\views/layouts/app.blade.php ENDPATH**/ ?>