<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACTUPRESS - Information & Analyses</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #f6f6f6; }
    </style>
</head>
<body class="bg-[#f6f6f6] text-[#212121] antialiased">

    
    <header class="bg-white border-b border-gray-200">
        <div class="container mx-auto px-4 h-16 flex items-center justify-between">
            
            <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-2 group">
                <div class="bg-[#bb1919] p-1 px-2 text-white font-black text-2xl tracking-tighter">ACTU</div>
                <span class="text-2xl font-black tracking-tighter text-[#212121]">PRESS</span>
            </a>

            
            <div class="flex items-center gap-4">
                <form action="<?php echo e(route('home')); ?>" method="GET" class="hidden md:relative md:block">
                    <input type="text" name="search" placeholder="Rechercher" 
                           class="bg-[#eeeeee] border-none text-sm px-4 py-2 w-48 focus:ring-2 focus:ring-[#bb1919] transition-all"
                           value="<?php echo e(request('search')); ?>">
                    <button type="submit" class="absolute right-2 top-2 text-gray-500 font-bold">🔍</button>
                </form>

                <?php if(auth()->guard()->guest()): ?>
                    <a href="<?php echo e(route('login')); ?>" class="flex items-center gap-1 text-sm font-bold border-l pl-4 border-gray-300 hover:text-[#bb1919]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="2"/></svg>
                        Connexion
                    </a>
                <?php endif; ?>

                <?php if(auth()->guard()->check()): ?>
                    <div class="flex items-center gap-3 border-l pl-4 border-gray-300">
                        <?php if(auth()->user()->email === 'admin@exple.com'): ?>
                            <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-xs font-black uppercase tracking-tighter text-[#bb1919] hover:underline">Dashboard</a>
                        <?php endif; ?>
                        <a href="<?php echo e(route('profile.show')); ?>" class="text-xs font-black uppercase tracking-tighter hover:text-[#bb1919]">Mon Compte</a>
                        <form action="<?php echo e(route('logout')); ?>" method="POST" class="inline">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="text-[#bb1919] text-xs font-black uppercase tracking-tighter">Sortir</button>
                        </form>
                    </div>
                <?php endif; ?>

                <button id="mobile-menu-btn" class="md:hidden p-2 text-[#212121]">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 6h16M4 12h16M4 18h16" /></svg>
                </button>
            </div>
        </div>
    </header>

    
    <nav class="bg-[#bb1919] sticky top-0 z-50 shadow-md overflow-x-auto no-scrollbar">
        <div class="container mx-auto px-4 flex items-center">
            <div class="hidden md:flex">
                <a href="<?php echo e(route('home')); ?>" class="px-4 py-3 text-sm font-bold text-white border-b-4 <?php echo e(request()->routeIs('home') && !request('search') ? 'border-white' : 'border-transparent hover:bg-white/10 transition-colors'); ?>">
                    Accueil
                </a>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('category.show', $category->slug)); ?>" 
                       class="px-4 py-3 text-sm font-bold text-white border-b-4 <?php echo e(request()->is('categorie/'.$category->slug) ? 'border-white' : 'border-transparent hover:bg-white/10 transition-colors'); ?>">
                        <?php echo e($category->name); ?>

                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('qsn')); ?>" class="px-4 py-3 text-sm font-bold text-white border-b-4 <?php echo e(request()->routeIs('qsn') ? 'border-white' : 'border-transparent hover:bg-white/10'); ?>">QSN</a>
                <a href="<?php echo e(route('contact')); ?>" class="px-4 py-3 text-sm font-bold text-white border-b-4 <?php echo e(request()->routeIs('contact') ? 'border-white' : 'border-transparent hover:bg-white/10'); ?>">Contact</a>
            </div>
        </div>
    </nav>

    
    <div id="mobile-menu" class="hidden bg-[#212121] text-white fixed inset-0 z-[60] p-6 overflow-y-auto">
        <div class="flex justify-between items-center mb-8">
            <span class="font-black text-2xl uppercase tracking-tighter">Menu</span>
            <button id="close-menu" class="p-2 bg-white/10 rounded-full">✕</button>
        </div>
        <div class="flex flex-col gap-6 text-xl font-bold">
            <a href="<?php echo e(route('home')); ?>">Accueil</a>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('category.show', $category->slug)); ?>" class="border-l-4 border-[#bb1919] pl-4"><?php echo e($category->name); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if(auth()->check() && auth()->user()->email === 'admin@exple.com'): ?>
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-[#bb1919]">Dashboard Admin</a>
            <?php endif; ?>
            <hr class="border-white/10">
            <a href="<?php echo e(route('qsn')); ?>" class="text-gray-400">À propos</a>
            <a href="<?php echo e(route('contact')); ?>" class="text-gray-400">Contact</a>
        </div>
    </div>

    <main class="container mx-auto px-4 py-8 min-h-screen">
        <?php if(session('success')): ?>
            <div class="bg-blue-600 text-white font-bold px-4 py-3 mb-8 flex justify-between items-center">
                <span><?php echo e(session('success')); ?></span>
                <button onclick="this.parentElement.remove()">✕</button>
            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </main>

    
    <footer class="bg-[#212121] text-white mt-20">
        <div class="container mx-auto px-4 py-12">
            <div class="flex flex-col md:flex-row justify-between items-start gap-12 border-b border-white/10 pb-12">
                <div class="max-w-xs">
                    <div class="text-3xl font-black tracking-tighter mb-4">ACTUPRESS<span class="text-[#bb1919]">.</span></div>
                    <p class="text-gray-400 text-sm leading-relaxed">L'information brute, analysée par nos experts. Une vision globale, un ancrage local.</p>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-8">
                    <div>
                        <h4 class="font-black text-xs uppercase tracking-widest text-gray-500 mb-4">Sections</h4>
                        <ul class="text-sm space-y-2 font-bold">
                            <?php $__currentLoopData = $categories->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(route('category.show', $category->slug)); ?>" class="hover:underline"><?php echo e($category->name); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-black text-xs uppercase tracking-widest text-gray-500 mb-4">Légal</h4>
                        <ul class="text-sm space-y-2 font-bold">
                            <li><a href="<?php echo e(route('qsn')); ?>" class="hover:underline">Qui sommes-nous ?</a></li>
                            <li><a href="<?php echo e(route('contact')); ?>" class="hover:underline">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest">
                <p>&copy; <?php echo e(date('Y')); ?> ACTUPRESS. PROJET RÉALISÉ PAR ALDADJ TECH.</p>
                <div class="flex gap-6">
                    <a href="#" class="hover:text-white transition-colors text-xs uppercase">Twitter</a>
                    <a href="#" class="hover:text-white transition-colors text-xs uppercase">Facebook</a>
                    <a href="#" class="hover:text-white transition-colors text-xs uppercase">YouTube</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Toggle Menu Mobile
        const btn = document.getElementById('mobile-menu-btn');
        const closeBtn = document.getElementById('close-menu');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', () => menu.classList.remove('hidden'));
        closeBtn.addEventListener('click', () => menu.classList.add('hidden'));

        // Script Like AJAX (Gardé de ta version précédente)
        async function toggleLike(btn, articleId) {
            <?php if(auth()->guard()->guest()): ?> window.location.href = "<?php echo e(route('login')); ?>"; return; <?php endif; ?>
            try {
                const response = await fetch(`/article/${articleId}/like`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                });
                const data = await response.json();
                const countSpan = btn.querySelector('.likes-count');
                countSpan.innerText = data.count;
                if (data.liked) { btn.classList.add('text-red-500'); } 
                else { btn.classList.remove('text-red-500'); }
            } catch (error) { console.error('Erreur:', error); }
        }
    </script>
</body>
</html><?php /**PATH C:\Users\alisn\Desktop\LARAVEL\projet\resources\views/layouts/app.blade.php ENDPATH**/ ?>