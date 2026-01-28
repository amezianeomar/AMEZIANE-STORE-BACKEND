@extends('Master_page')

@section('content')
<div class="min-h-screen py-6 px-4 sm:py-12 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto bg-brand-surface border border-white/10 rounded-xl shadow-2xl overflow-hidden animate-fade-in-up">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-brand-dark to-brand-surface p-4 sm:p-6 border-b border-white/5">
            <h2 class="text-xl sm:text-2xl font-display font-bold text-white text-center tracking-wider">
                AJOUTER UN <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-neon to-brand-magenta">PRODUIT</span>
            </h2>
            <p class="mt-2 text-center text-xs sm:text-sm text-gray-400">Remplissez les détails pour enrichir le catalogue.</p>
        </div>

        <!-- GODLY SUCCESS MODAL -->
        @if(session('success'))
        <div x-data="{ show: true }" x-show="show" class="fixed inset-0 z-[60] flex items-center justify-center bg-black/80 backdrop-blur-sm animate-fade-in">
            <div class="bg-brand-dark/95 border-2 border-brand-neon p-1 rounded-2xl shadow-[0_0_50px_rgba(0,255,0,0.5)] transform scale-100 animate-bounce-slow max-w-lg w-full mx-4">
                <div class="bg-gradient-to-b from-gray-900 to-black rounded-xl p-8 text-center relative overflow-hidden">
                    
                    <!-- Background Glow -->
                    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-32 bg-brand-neon/20 blur-3xl rounded-full pointer-events-none"></div>

                    <!-- Icon / Image -->
                    <div class="relative z-10 mb-6 group">
                        <div class="mx-auto w-32 h-32 rounded-full border-4 border-brand-neon shadow-[0_0_20px_rgba(57,255,20,0.5)] overflow-hidden bg-black flex items-center justify-center group-hover:scale-105 transition-transform duration-500">
                            @if(session('product_image'))
                                <img src="{{ session('product_image') }}" alt="Product" class="w-full h-full object-cover">
                            @else
                                <svg class="w-16 h-16 text-brand-neon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            @endif
                        </div>
                        <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 bg-brand-neon text-black text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest shadow-lg">
                            Legendary Item
                        </div>
                    </div>

                    <!-- Title -->
                    <h3 class="text-3xl font-display font-bold text-white mb-2 drop-shadow-[0_2px_2px_rgba(0,0,0,0.8)]">
                        MISSION ACCOMPLIE !
                    </h3>
                    <p class="text-brand-neon font-mono text-sm uppercase tracking-[0.2em] mb-6">
                        Produit Ajouté au Catalogue
                    </p>

                    <!-- Product Name -->
                    @if(session('product_name'))
                    <div class="bg-white/5 border border-white/10 rounded-lg p-4 mb-6">
                        <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Nouveau Loot</p>
                        <p class="text-xl text-white font-bold">{{ session('product_name') }}</p>
                    </div>
                    @endif

                    <!-- Action Button -->
                    <button @click="show = false" class="w-full py-3 bg-brand-neon hover:bg-white text-black font-bold uppercase tracking-widest rounded-lg transition-all duration-300 shadow-[0_0_15px_rgba(57,255,20,0.4)] hover:shadow-[0_0_25px_rgba(255,255,255,0.6)]">
                        CONTINUER
                    </button>
                    
                </div>
            </div>
        </div>
        @endif

        <!-- Form -->
        <form action="{{ route('produits.store') }}" method="POST" enctype="multipart/form-data" class="p-4 sm:p-6 space-y-6">
            @csrf

            <!-- Nom -->
            <div>
                <label for="nom" class="block text-sm font-medium text-gray-300">Nom du Produit</label>
                <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required
                    class="mt-1 block w-full px-3 py-2 bg-brand-dark border border-white/10 rounded-md text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-brand-neon focus:border-transparent transition-all duration-300">
                @error('nom')
                    <p class="mt-1 text-xs text-red-400 shadow-[0_0_10px_rgba(255,0,0,0.2)]">{{ $message }}</p>
                @enderror
            </div>

            <!-- Prix -->
            <div>
                <label for="prix" class="block text-sm font-medium text-gray-300">Prix (MAD)</label>
                <input type="number" name="prix" id="prix" value="{{ old('prix') }}" required step="0.01"
                    class="mt-1 block w-full px-3 py-2 bg-brand-dark border border-white/10 rounded-md text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-brand-neon focus:border-transparent transition-all duration-300">
                @error('prix')
                    <p class="mt-1 text-xs text-red-400 shadow-[0_0_10px_rgba(255,0,0,0.2)]">{{ $message }}</p>
                @enderror
            </div>

            <!-- Catégorie -->
            <div>
                <label for="categorie" class="block text-sm font-medium text-gray-300">Catégorie</label>
                <select name="categorie" id="categorie" required
                    class="mt-1 block w-full px-3 py-2 bg-brand-dark border border-white/10 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-brand-neon focus:border-transparent transition-all duration-300">
                    <option value="" disabled selected>Choisir une catégorie</option>
                    @foreach(['consoles', 'monitors', 'son', 'claviers', 'souris', 'chaises', 'video-games', 'cartes-graphiques'] as $cat)
                        <option value="{{ $cat }}" {{ old('categorie') == $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                    @endforeach
                </select>
                @error('categorie')
                    <p class="mt-1 text-xs text-red-400 shadow-[0_0_10px_rgba(255,0,0,0.2)]">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="desc" class="block text-sm font-medium text-gray-300">Description</label>
                <textarea name="desc" id="desc" rows="3"
                    class="mt-1 block w-full px-3 py-2 bg-brand-dark border border-white/10 rounded-md text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-brand-neon focus:border-transparent transition-all duration-300">{{ old('desc') }}</textarea>
            </div>

            <!-- Image + Preview -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-300 mb-2">Image du Produit</label>
                
                <!-- Image Preview Container -->
                <div id="image-preview" class="hidden mb-4 rounded-lg overflow-hidden border-2 border-brand-neon/50 shadow-[0_0_15px_rgba(0,0,0,0.5)] relative group">
                    <img id="preview-img" src="#" alt="Aperçu" class="w-full h-48 object-cover transform group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="text-white font-bold tracking-widest text-sm">APERÇU</span>
                    </div>
                </div>

                <input type="file" name="image" id="image" required accept="image/*"
                    onchange="previewImage(event)"
                    class="mt-1 block w-full text-sm text-gray-400
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-brand-neon_20 file:text-brand-neon
                    hover:file:bg-brand-neon_30 cursor-pointer">
                <p class="mt-1 text-xs text-gray-500">PNG, JPG, GIF jusqu'à 2Mo.</p>
                @error('image')
                    <p class="mt-1 text-xs text-red-400 shadow-[0_0_10px_rgba(255,0,0,0.2)]">{{ $message }}</p>
                @enderror
            </div>

            <script>
                function previewImage(event) {
                    const reader = new FileReader();
                    const imageField = document.getElementById("image");
                    const previewContainer = document.getElementById("image-preview");
                    const previewImg = document.getElementById("preview-img");

                    reader.onload = function(){
                        if(reader.readyState == 2){
                            previewImg.src = reader.result;
                            previewContainer.classList.remove("hidden");
                        }
                    }

                    if(event.target.files[0]){
                        reader.readAsDataURL(event.target.files[0]);
                    }
                }
            </script>

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-black bg-brand-neon hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-neon transition-all duration-300 transform hover:scale-[1.02]">
                    AJOUTER LE PRODUIT
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
