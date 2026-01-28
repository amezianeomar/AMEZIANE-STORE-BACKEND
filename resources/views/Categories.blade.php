@extends('Master_page')

@section('content')
<div class="mb-12 text-center">
    <h2 class="font-display font-bold text-4xl md:text-5xl text-white mb-4 animate-fade-in-up">
        NOS <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-neon to-brand-magenta">CATÉGORIES</span>
    </h2>
    <p class="text-gray-400 text-lg max-w-2xl mx-auto">Explorez notre catalogue complet et trouvez l'équipement qui vous mènera à la victoire.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    @php
        $cats = [
            ['id' => 'consoles', 'name' => 'Consoles', 'img' => 'https://www.stuff.tv/wp-content/uploads/sites/2/2024/08/Best-Gaming-Consoles-Hero-Image.jpg?quality=75'],
            ['id' => 'monitors', 'name' => 'Écrans', 'img' => 'https://www.scorptec.com.au/images/icons/cmspages/18/1029.jpg'],
            ['id' => 'son', 'name' => 'Audio', 'img' => 'https://lynia-shop.com/wp-content/uploads/2022/08/Casque-Audio-Stereo-Hi-FI-100-Heure-de-Lecture-Bluetooth-5.0-avec-HD-LYNIA-BENIN.jpg'],
            ['id' => 'claviers', 'name' => 'Claviers', 'img' => 'https://cdn.cultura.com/cdn-cgi/image/width=830/media/pim/0840006639787_4_130_CNET_FR.jpg'],
            ['id' => 'souris', 'name' => 'Souris', 'img' => 'https://m.media-amazon.com/images/I/61fEpBysnmL._AC_SL1280_.jpg'],
            ['id' => 'chaises', 'name' => 'Chaises', 'img' => 'https://chaisegaming.store/cdn/shop/files/4.png?v=1717812629&width=1445'],
            ['id' => 'video-games', 'name' => 'Jeux Vidéo', 'img' => 'https://media.gq-magazine.co.uk/photos/645b5c3c8223a5c3801b8b26/16:9/w_2560%2Cc_limit/100-best-games-hp-b.jpg'],
            ['id' => 'cartes-graphiques', 'name' => 'Composants', 'img' => 'https://www.cdiscount.com/pdt2/g/o/c/1/550x550/gvn3060gamingoc/rw/carte-graphique-gigabyte-rtx-3060-gaming-oc-12g-lh.jpg'],
        ];
    @endphp

    @foreach($cats as $cat)
        <a href="{{ route('produits.categorie', $cat['id']) }}" class="group relative h-64 rounded-2xl overflow-hidden border border-white/5 hover:border-brand-neon transition-all duration-300 transform hover:-translate-y-2 hover:shadow-[0_0_25px_rgba(0,255,255,0.3)]">
            <!-- Background Image -->
            <img src="{{ $cat['img'] }}" 
                 alt="{{ $cat['name'] }}" 
                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-70 group-hover:opacity-100">
            
            <!-- Overlay Gradient -->
            <div class="absolute inset-0 bg-gradient-to-t from-brand-dark via-brand-dark/50 to-transparent"></div>

            <!-- Content -->
            <div class="absolute bottom-0 left-0 w-full p-6 text-center">
                <h3 class="font-display text-2xl font-bold text-white tracking-wider uppercase group-hover:text-brand-neon transition-colors drop-shadow-lg">
                    {{ $cat['name'] }}
                </h3>
                <span class="inline-block mt-2 text-xs font-bold text-brand-magenta tracking-widest opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all duration-300">
                    DÉCOUVRIR
                </span>
            </div>
        </a>
    @endforeach
</div>
@endsection
