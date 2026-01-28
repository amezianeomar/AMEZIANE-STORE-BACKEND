@extends('Master_page')

@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8 flex flex-col items-center justify-center">
    
    <div class="text-center mb-16 animate-fade-in-up">
        <h1 class="text-5xl md:text-7xl font-display font-bold text-white mb-4 tracking-tight">
            GOD <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-neon to-brand-magenta">PORTAL</span>
        </h1>
        <p class="text-gray-400 text-lg md:text-xl font-light tracking-widest uppercase">
            Administration du Multivers
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full max-w-4xl animate-fade-in-up delay-100">
        
        <!-- Action 1: Create -->
        <a href="{{ route('produits.create') }}" class="group relative block h-64 bg-brand-surface rounded-2xl border border-white/5 overflow-hidden hover:border-brand-neon transition-all duration-500 hover:shadow-[0_0_30px_rgba(57,255,20,0.3)] hover:-translate-y-2">
            <div class="absolute inset-0 bg-gradient-to-br from-brand-dark to-brand-surface opacity-90 group-hover:opacity-75 transition-opacity duration-500"></div>
            <div class="absolute inset-0 flex flex-col items-center justify-center p-8 text-center z-10">
                <div class="w-20 h-20 rounded-full bg-brand-neon/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500 border border-brand-neon/20 group-hover:border-brand-neon">
                    <svg class="w-10 h-10 text-brand-neon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <h3 class="text-2xl font-display font-bold text-white mb-2 group-hover:text-brand-neon transition-colors">AJOUTER UN ARTEFACT</h3>
                <p class="text-gray-400 text-sm">Créer un nouveau produit légendaire pour le catalogue.</p>
            </div>
        </a>

        <!-- Action 2: Manage -->
        <a href="{{ route('admin.products') }}" class="group relative block h-64 bg-brand-surface rounded-2xl border border-white/5 overflow-hidden hover:border-brand-magenta transition-all duration-500 hover:shadow-[0_0_30px_rgba(255,0,255,0.3)] hover:-translate-y-2">
            <div class="absolute inset-0 bg-gradient-to-br from-brand-dark to-brand-surface opacity-90 group-hover:opacity-75 transition-opacity duration-500"></div>
            <div class="absolute inset-0 flex flex-col items-center justify-center p-8 text-center z-10">
                <div class="w-20 h-20 rounded-full bg-brand-magenta/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500 border border-brand-magenta/20 group-hover:border-brand-magenta">
                    <svg class="w-10 h-10 text-brand-magenta" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </div>
                <h3 class="text-2xl font-display font-bold text-white mb-2 group-hover:text-brand-magenta transition-colors">GÉRER L'INVENTAIRE</h3>
                <p class="text-gray-400 text-sm">Modifier, supprimer et filtrer les produits existants.</p>
            </div>
        </a>

    </div>

</div>
@endsection
