@extends('Master_page')

@section('content')
<div class="mb-8 md:mb-12 text-center md:text-left px-2">
    <h2 class="font-display font-bold text-3xl md:text-4xl text-white mb-4">
        CATÉGORIE <span class="text-brand-neon">/</span> {{ strtoupper($titre) }}
    </h2>
    <div class="h-1 w-20 bg-brand-magenta rounded mx-auto md:mx-0"></div>
</div>

@if(count($liste) > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 pb-8">
        @foreach($liste as $produit)
            <div class="group bg-brand-surface rounded-xl overflow-hidden border border-white/5 hover:border-brand-neon transition-all duration-300 transform active:scale-95 hover:-translate-y-2 hover:shadow-[0_0_20px_rgba(0,255,255,0.2)] flex flex-col h-full">
                <!-- Image Wrapper -->
                <div class="relative h-56 md:h-64 overflow-hidden shrink-0">
                    <img src="{{ $produit->image }}" 
                         alt="{{ $produit->nom }}" 
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-brand-surface to-transparent opacity-80"></div>
                    
                    <!-- Price Badge -->
                    <div class="absolute top-4 right-4 bg-brand-violet/90 backdrop-blur-sm text-white font-display font-bold px-4 py-2 rounded shadow-lg border border-brand-violet">
                        {{ $produit->prix }} DHS
                    </div>
                </div>

                <!-- Content -->
                <div class="p-5 md:p-6 flex flex-col flex-grow">
                    <h3 class="font-display text-xl md:text-2xl font-bold text-white mb-2 group-hover:text-brand-neon transition-colors line-clamp-1">
                        {{ $produit->nom }}
                    </h3>
                    <p class="text-gray-400 text-sm mb-6 h-auto md:h-10 overflow-hidden line-clamp-2">
                        {{ $produit->desc }}
                    </p>
                    
                    <a href="{{ route('produits.show', $produit->id) }}" class="mt-auto w-full bg-white/5 hover:bg-brand-neon hover:text-black text-white font-display font-bold py-3 rounded border border-white/10 hover:border-brand-neon transition-all uppercase tracking-wider flex items-center justify-center gap-2 group-hover:shadow-[0_0_15px_rgba(57,255,20,0.4)]">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        CHECK INFOS
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    
    <!-- Pagination -->
    <div class="mt-8 flex justify-center">
        <div class="bg-brand-surface px-4 py-2 rounded-lg border border-white/5">
             {{ $liste->links() }}
        </div>
    </div>
@else
    <div class="text-center py-20 px-4">
        <h3 class="text-xl md:text-2xl text-gray-400">Aucun produit trouvé dans cette catégorie.</h3>
    </div>
@endif
@endsection
