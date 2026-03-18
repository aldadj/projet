

<?php $__env->startSection('content'); ?>
<div class="bg-white min-h-screen">
    
    
    <div class="relative border-b-8 border-[#212121] bg-[#f8f8f8] py-20">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end gap-10">
                <div class="max-w-2xl">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="w-12 h-1.5 bg-[#bb1919]"></span>
                        <span class="text-[#bb1919] font-black uppercase tracking-[0.3em] text-xs">Notre Manifeste</span>
                    </div>
                    <h1 class="text-6xl md:text-8xl font-black text-[#212121] leading-[0.9] tracking-tighter uppercase">
                        L'info <br>
                        <span class="text-transparent" style="-webkit-text-stroke: 2px #212121;">sans filtre.</span>
                    </h1>
                </div>
                <div class="hidden md:block pb-4">
                    <p class="text-right text-[10px] font-black uppercase tracking-widest text-gray-400 rotate-90 origin-bottom-right">
                        Établi à Ouagadougou • <?php echo e(date('Y')); ?>

                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-6 py-16">
        <div class="grid lg:grid-cols-12 gap-16">
            
            
            <div class="lg:col-span-4 space-y-12">
                <div class="border-t-4 border-[#212121] pt-6">
                    <h3 class="text-xl font-black uppercase tracking-tight mb-4 text-[#bb1919]">Notre Mission</h3>
                    <p class="text-sm font-bold text-gray-600 leading-relaxed uppercase tracking-tighter">
                        Apporter une clarté absolue dans un monde de bruit numérique. ActuPress s'engage à la vérification stricte des faits.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-4">
                    <div class="bg-[#212121] p-6 text-white group hover:bg-[#bb1919] transition-colors cursor-default">
                        <span class="text-4xl block mb-4">🚀</span>
                        <h4 class="font-black uppercase tracking-widest text-xs mb-2">Technologie</h4>
                        <p class="text-[11px] text-gray-400 font-bold group-hover:text-white transition-colors uppercase">Innover via des solutions comme WHOIS pour la fiabilité réseau.</p>
                    </div>
                    <div class="bg-gray-100 p-6 text-[#212121] group hover:bg-[#212121] hover:text-white transition-all cursor-default">
                        <span class="text-4xl block mb-4">💡</span>
                        <h4 class="font-black uppercase tracking-widest text-xs mb-2">Vision</h4>
                        <p class="text-[11px] text-gray-500 font-bold group-hover:text-gray-300 transition-colors uppercase">Devenir le premier hub d'information technologique au Burkina Faso.</p>
                    </div>
                </div>
            </div>

            
            <div class="lg:col-span-8 relative">
                
                <span class="absolute -top-20 -left-10 text-[20rem] text-gray-50 font-serif select-none -z-10">“</span>
                
                <div class="prose prose-xl prose-slate max-w-none">
                    <div class="text-[#333] leading-[1.6] font-serif text-2xl space-y-8 first-letter:text-7xl first-letter:font-black first-letter:text-[#bb1919] first-letter:mr-3 first-letter:float-left">
                        <?php echo nl2br(e(optional($qsn ?? null)->value ?? 'Notre histoire commence par une volonté de transparence... Nous construisons actuellement cet espace pour vous.')); ?>

                    </div>
                </div>

                
                <div class="mt-16 pt-10 border-t-2 border-gray-100 flex flex-col md:flex-row justify-between items-center gap-8">
                    <div class="flex items-center gap-6">
                        <div class="relative">
                            <div class="w-16 h-16 bg-[#212121] rounded-none rotate-3 absolute inset-0"></div>
                            <div class="w-16 h-16 bg-[#bb1919] rounded-none flex items-center justify-center text-white font-black text-2xl relative z-10">A</div>
                        </div>
                        <div>
                            <p class="text-sm font-black uppercase tracking-widest text-[#212121]">Ali Belem</p>
                            <p class="text-[10px] font-bold text-[#bb1919] uppercase tracking-tighter">Fondateur & Ingénieur IT</p>
                        </div>
                    </div>

                    <div class="flex gap-6 items-center">
                        <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">Suivez l'aventure</span>
                        <div class="flex gap-4">
                            <a href="#" class="w-10 h-10 border border-gray-200 flex items-center justify-center hover:bg-[#bb1919] hover:text-white transition-all font-bold text-xs">𝕏</a>
                            <a href="#" class="w-10 h-10 border border-gray-200 flex items-center justify-center hover:bg-[#0077b5] hover:text-white transition-all font-bold text-xs">IN</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Typographie style Journal/Gazette */
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,900;1,400&display=swap');
    
    .font-serif {
        font-family: 'Georgia', serif;
    }
    
    .text-6xl {
        font-family: 'Playfair Display', serif;
    }

    /* Justification propre du texte pour le look Presse */
    .prose div {
        text-align: justify;
        hyphens: auto;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\alisn\Desktop\LARAVEL\projet\resources\views/qsn.blade.php ENDPATH**/ ?>