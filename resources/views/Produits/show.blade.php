@extends('Master_page')

@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    
    <!-- Breadcrumb -->
    <nav class="flex mb-8 animate-fade-in-up" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-white">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                    Accueil
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <a href="{{ route('produits.categorie', $product->categorie) }}" class="ml-1 text-sm font-medium text-gray-400 hover:text-white md:ml-2 uppercase">{{ $product->categorie }}</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <span class="ml-1 text-sm font-medium text-brand-neon md:ml-2">{{ $product->nom }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Product Showcase -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start animate-fade-in-up delay-100">
        
        <!-- Left: Image -->
        <div class="relative group">
            <div class="absolute -inset-1 bg-gradient-to-r from-brand-neon to-brand-magenta rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
            <div class="relative rounded-2xl overflow-hidden bg-brand-surface border border-white/10 shadow-2xl">
                <img src="{{ $product->image }}" alt="{{ $product->nom }}" class="w-full object-cover transform transition-transform duration-700 group-hover:scale-105">
                
                <!-- Zoom Hitbox (Visual Only) -->
                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                    <span class="bg-black/50 backdrop-blur-md text-white px-4 py-2 rounded-full border border-white/20 text-xs font-bold uppercase tracking-widest">
                        Zoom HD
                    </span>
                </div>
            </div>
        </div>

        <!-- Right: Details -->
        <div class="flex flex-col space-y-8">
            
            <!-- Header -->
            <div>
                 <span class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-neon/10 text-brand-neon border border-brand-neon/20 mb-4">
                    {{ ucfirst($product->categorie) }} Edition
                </span>
                <h1 class="text-4xl md:text-5xl font-display font-bold text-white mb-4 leading-tight">
                    {{ $product->nom }}
                </h1>
                <div class="flex items-center space-x-4">
                    <p class="text-3xl font-mono text-brand-magenta font-bold">
                        {{ $product->prix }} <span class="text-lg">DHS</span>
                    </p>
                    <span class="text-green-400 text-sm font-bold flex items-center">
                        <span class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></span>
                        En Stock
                    </span>
                </div>
            </div>

            <!-- Description -->
            <div class="prose prose-invert max-w-none text-gray-300 border-t border-white/10 pt-8">
                <p class="leading-relaxed">
                    {{ $product->desc }}
                </p>
            </div>

            <!-- Actions -->
            <div class="flex flex-row gap-4 border-t border-white/10 pt-8 mt-auto">
                <button class="w-[80%] bg-brand-neon hover:bg-white text-black font-display font-bold py-4 rounded-xl shadow-[0_0_20px_rgba(57,255,20,0.3)] hover:shadow-[0_0_30px_rgba(255,255,255,0.5)] transition-all transform hover:-translate-y-1 flex items-center justify-center gap-3">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="truncate">AJOUTER AU PANIER</span>
                </button>
                
                <button class="w-[20%] p-4 bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 hover:border-brand-magenta hover:text-brand-magenta transition-all text-gray-400 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </button>
            </div>
            
            <!-- Features/Specs (Static for now) -->
            <div class="grid grid-cols-2 gap-4 text-xs text-gray-500 uppercase tracking-widest pt-4">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    Livraison Rapide
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Garantie 2 Ans
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
