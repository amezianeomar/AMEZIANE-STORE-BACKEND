@extends('Master_page')

@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8" x-data="{ 
    showDeleteModal: false, 
    deleteUrl: '',
    openDeleteModal(url) {
        this.deleteUrl = url;
        this.showDeleteModal = true;
    }
}">
    
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 border-b border-white/10 pb-6">
        <div>
            <h1 class="text-3xl md:text-4xl font-display font-bold text-white mb-2">
                INVENTAIRE <span class="text-brand-magenta">GOD MODE</span>
            </h1>
            <p class="text-gray-400">Gestion complète du catalogue ({{ $products->total() }} items)</p>
        </div>
        <div class="mt-4 md:mt-0 flex space-x-4">
            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-white/5 text-gray-300 rounded hover:bg-white/10 transition-colors uppercase font-bold text-sm tracking-widest border border-white/10">
                Retour Dashboard
            </a>
            <a href="{{ route('produits.create') }}" class="px-4 py-2 bg-brand-neon text-black rounded hover:bg-white transition-colors uppercase font-bold text-sm tracking-widest shadow-[0_0_15px_rgba(57,255,20,0.3)]">
                + Nouveau Produit
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-brand-surface border border-white/5 rounded-xl p-6 mb-8 shadow-xl">
        <form action="{{ route('admin.products') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="md:col-span-2">
                <label for="search" class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Rechercher</label>
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nom du produit..." class="w-full bg-brand-dark border border-white/10 rounded px-4 py-2 text-white placeholder-gray-600 focus:outline-none focus:border-brand-neon transition-colors">
                    <svg class="w-5 h-5 text-gray-600 absolute right-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </div>
            <div>
                <label for="category" class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Catégorie</label>
                <select name="category" onchange="this.form.submit()" class="w-full bg-brand-dark border border-white/10 rounded px-4 py-2 text-white focus:outline-none focus:border-brand-magenta transition-colors">
                    <option value="">Toutes</option>
                    @foreach(['consoles', 'monitors', 'son', 'claviers', 'souris', 'chaises', 'video-games', 'cartes-graphiques'] as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full bg-brand-violet/20 hover:bg-brand-violet/40 text-brand-violet border border-brand-violet/50 hover:border-brand-violet px-4 py-2 rounded font-bold uppercase transition-all">
                    Filtrer
                </button>
            </div>
        </form>
    </div>

    <!-- Desktop Table (Hidden on Mobile) -->
    <div class="hidden md:block bg-brand-surface border border-white/5 rounded-xl overflow-hidden shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-brand-dark/50 border-b border-white/5">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Aperçu</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Nom</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Catégorie</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Prix</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($products as $product)
                        <tr class="hover:bg-white/5 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="w-12 h-12 rounded-lg overflow-hidden border border-white/10 group-hover:border-brand-neon transition-colors">
                                    <img src="{{ $product->image }}" alt="" class="w-full h-full object-cover">
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-white group-hover:text-brand-neon transition-colors">{{ $product->nom }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-white/5 text-gray-400 border border-white/10">
                                    {{ ucfirst($product->categorie) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-mono text-brand-magenta font-bold">{{ $product->prix }} DHS</span>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('produits.edit', $product->id) }}" class="inline-flex items-center text-gray-400 hover:text-brand-neon transition-colors" title="Modifier">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                </a>
                                <button @click="openDeleteModal('{{ route('produits.destroy', $product->id) }}')" class="inline-flex items-center text-gray-400 hover:text-red-500 transition-colors" title="Supprimer">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                Aucun artefact trouvé dans l'inventaire.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Desktop Pagination -->
        @if($products->hasPages())
        <div class="px-6 py-4 border-t border-white/5 bg-brand-dark/20">
            {{ $products->appends(request()->query())->links() }}
        </div>
        @endif
    </div>

    <!-- Mobile Card View (Visible ONLY on Mobile) -->
    <div class="md:hidden space-y-4">
        @forelse($products as $product)
            <div class="bg-brand-surface border border-white/5 rounded-xl p-4 shadow-lg flex items-center space-x-4">
                <!-- Image -->
                <div class="w-20 h-20 rounded-lg overflow-hidden border border-white/10 shrink-0">
                    <img src="{{ $product->image }}" alt="" class="w-full h-full object-cover">
                </div>
                
                <!-- Info -->
                <div class="flex-grow min-w-0">
                    <h3 class="font-bold text-white truncate">{{ $product->nom }}</h3>
                    <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">{{ ucfirst($product->categorie) }}</p>
                    <p class="font-mono text-brand-magenta font-bold">{{ $product->prix }} DHS</p>
                </div>

                <!-- Actions -->
                <div class="flex flex-col space-y-2">
                    <a href="{{ route('produits.edit', $product->id) }}" class="p-2 bg-white/5 rounded text-gray-400 hover:text-brand-neon hover:bg-white/10 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                    </a>
                    <button @click="openDeleteModal('{{ route('produits.destroy', $product->id) }}')" class="p-2 bg-white/5 rounded text-gray-400 hover:text-red-500 hover:bg-white/10 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    </button>
                </div>
            </div>
        @empty
            <div class="text-center py-12 text-gray-500">
                Aucun artefact trouvé.
            </div>
        @endforelse

        <!-- Mobile Pagination -->
        @if($products->hasPages())
        <div class="py-4">
            {{ $products->appends(request()->query())->links() }}
        </div>
        @endif
    </div>

    <!-- Alpine.js Delete Modal -->
    <div x-show="showDeleteModal" 
         class="fixed inset-0 z-[100] flex items-center justify-center bg-black/90 backdrop-blur-sm animate-fade-in"
         x-cloak>
        <div class="bg-brand-dark border-2 border-red-600 p-1 rounded-2xl shadow-[0_0_50px_rgba(255,0,0,0.6)] transform scale-100 animate-bounce-slow max-w-md w-full mx-4"
             @click.away="showDeleteModal = false">
            <div class="bg-gradient-to-b from-gray-900 to-black rounded-xl p-8 text-center relative overflow-hidden">
                <div class="mx-auto w-20 h-20 bg-red-500/10 rounded-full flex items-center justify-center mb-6 border border-red-500 shadow-[0_0_20px_rgba(255,0,0,0.4)]">
                    <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <h3 class="text-2xl font-display font-bold text-white mb-2">Zone Dangereuse</h3>
                <p class="text-gray-400 text-sm mb-6">Êtes-vous sûr de vouloir supprimer cet item légendaire ? Cette action est irréversible.</p>
                <div class="flex space-x-4">
                    <button @click="showDeleteModal = false" class="flex-1 py-3 border border-white/10 rounded-lg text-gray-300 hover:bg-white/5 font-bold uppercase transition-all">Annuler</button>
                    <form :action="deleteUrl" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full py-3 bg-red-600 hover:bg-red-700 text-white font-bold uppercase rounded-lg shadow-[0_0_15px_rgba(255,0,0,0.4)] transition-all">CONFIRMER</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- GODLY SUCCESS MODAL -->
    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/80 backdrop-blur-sm animate-fade-in" x-cloak>
        <div class="bg-brand-dark/95 border-2 border-brand-neon p-1 rounded-2xl shadow-[0_0_50px_rgba(0,255,0,0.5)] transform scale-100 animate-bounce-slow max-w-lg w-full mx-4" @click.away="show = false">
            <div class="bg-gradient-to-b from-gray-900 to-black rounded-xl p-8 text-center relative overflow-hidden">
                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-32 bg-brand-neon/20 blur-3xl rounded-full pointer-events-none"></div>
                <!-- Icon -->
                <div class="relative z-10 mb-6 group">
                    <div class="mx-auto w-24 h-24 rounded-full border-4 border-brand-neon shadow-[0_0_20px_rgba(57,255,20,0.5)] overflow-hidden bg-black flex items-center justify-center">
                        <svg class="w-12 h-12 text-brand-neon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                </div>
                <h3 class="text-3xl font-display font-bold text-white mb-2 drop-shadow-[0_2px_2px_rgba(0,0,0,0.8)]">SUCCÈS !</h3>
                <p class="text-brand-neon font-mono text-sm uppercase tracking-[0.2em] mb-6">OPÉRATION DIVINE EFFECTUÉE</p>
                <div class="bg-white/5 border border-white/10 rounded-lg p-4 mb-6">
                    <p class="text-xl text-white font-bold">{{ session('success') }}</p>
                </div>
                <button @click="show = false" class="w-full py-3 bg-brand-neon hover:bg-white text-black font-bold uppercase tracking-widest rounded-lg transition-all duration-300 shadow-[0_0_15px_rgba(57,255,20,0.4)] hover:shadow-[0_0_25px_rgba(255,255,255,0.6)]">
                    CONTINUER
                </button>
            </div>
        </div>
    </div>
    @endif

</div>
@endsection
