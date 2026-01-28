@extends('Master_page')

@section('content')
<div class="min-h-screen py-6 px-4 sm:py-12 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto bg-brand-surface border border-white/10 rounded-xl shadow-2xl overflow-hidden animate-fade-in-up">
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-brand-dark to-brand-surface p-4 sm:p-6 border-b border-white/5">
            <h2 class="text-xl sm:text-2xl font-display font-bold text-white text-center tracking-wider">
                MODIFIER LE <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-neon to-brand-magenta">PRODUIT</span>
            </h2>
            <p class="mt-2 text-center text-xs sm:text-sm text-gray-400">Mettez à jour les stats de cet item.</p>
        </div>

        <!-- Form -->
        <form action="{{ route('produits.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="p-4 sm:p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Nom -->
            <div>
                <label for="nom" class="block text-sm font-medium text-gray-300">Nom du Produit</label>
                <input type="text" name="nom" id="nom" value="{{ old('nom', $product->nom) }}" required
                    class="mt-1 block w-full px-3 py-2 bg-brand-dark border border-white/10 rounded-md text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-brand-neon focus:border-transparent transition-all duration-300">
                @error('nom')
                    <p class="mt-1 text-xs text-red-400 shadow-[0_0_10px_rgba(255,0,0,0.2)]">{{ $message }}</p>
                @enderror
            </div>

            <!-- Prix -->
            <div>
                <label for="prix" class="block text-sm font-medium text-gray-300">Prix (MAD)</label>
                <input type="number" name="prix" id="prix" value="{{ old('prix', $product->prix) }}" required step="0.01"
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
                    <option value="" disabled>Choisir une catégorie</option>
                    @foreach(['consoles', 'monitors', 'son', 'claviers', 'souris', 'chaises', 'video-games', 'cartes-graphiques'] as $cat)
                        <option value="{{ $cat }}" {{ old('categorie', $product->categorie) == $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
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
                    class="mt-1 block w-full px-3 py-2 bg-brand-dark border border-white/10 rounded-md text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-brand-neon focus:border-transparent transition-all duration-300">{{ old('desc', $product->desc) }}</textarea>
            </div>

            <!-- Image + Preview -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-300 mb-2">Image du Produit</label>
                
                <!-- Current/New Image Preview Container -->
                <div id="image-preview" class="mb-4 rounded-lg overflow-hidden border-2 border-brand-neon/50 shadow-[0_0_15px_rgba(0,0,0,0.5)] relative group">
                    <img id="preview-img" src="{{ $product->image }}" alt="Aperçu" class="w-full h-48 object-cover transform group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="text-white font-bold tracking-widest text-sm">NOUVEL APERÇU</span>
                    </div>
                </div>

                <input type="file" name="image" id="image" accept="image/*"
                    onchange="previewImage(event)"
                    class="mt-1 block w-full text-sm text-gray-400
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-brand-neon_20 file:text-brand-neon
                    hover:file:bg-brand-neon_30 cursor-pointer">
                <p class="mt-1 text-xs text-gray-500">Laisser vide pour garder l'image actuelle.</p>
                @error('image')
                    <p class="mt-1 text-xs text-red-400 shadow-[0_0_10px_rgba(255,0,0,0.2)]">{{ $message }}</p>
                @enderror
            </div>

            <script>
                function previewImage(event) {
                    const reader = new FileReader();
                    const previewImg = document.getElementById("preview-img");

                    reader.onload = function(){
                        if(reader.readyState == 2){
                            previewImg.src = reader.result;
                        }
                    }

                    if(event.target.files[0]){
                        reader.readAsDataURL(event.target.files[0]);
                    }
                }
            </script>

            <!-- Submit Button -->
            <div class="pt-4 flex space-x-4">
                <a href="{{ url()->previous() }}" class="w-1/3 flex justify-center py-2 px-4 border border-white/10 rounded-md text-sm font-medium text-gray-300 hover:bg-white/5 transition-all">
                    ANNULER
                </a>
                <button type="submit"
                    class="w-2/3 flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-black bg-brand-neon hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-neon transition-all duration-300 transform hover:scale-[1.02]">
                    SAUVEGARDER
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
