<nav class="bg-brand-surface border-b border-white/10 relative z-50" x-data="{ mobileMenuOpen: false }">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-20">
            <a href="{{ route('home') }}" class="flex items-center space-x-2 group z-50 relative">
                <div class="w-10 h-10 bg-gradient-to-br from-brand-violet to-brand-magenta rounded flex items-center justify-center transform group-hover:rotate-12 transition-transform shadow-[0_0_15px_rgba(240,0,255,0.5)]">
                    <span class="font-display font-bold text-xl text-white">A</span>
                </div>
                <span class="font-display font-bold text-2xl tracking-wider text-white group-hover:text-brand-neon transition-colors drop-shadow-lg">
                    AMEZIANE<span class="text-brand-magenta">-STORE</span>
                </span>
            </a>

            <div class="hidden md:flex space-x-8">
                <a href="{{ route('home') }}" class="font-display text-sm font-medium text-gray-300 hover:text-brand-neon transition-colors uppercase tracking-widest hover:border-b-2 hover:border-brand-neon py-2 {{ request()->routeIs('home', 'root') ? 'text-brand-neon border-b-2 border-brand-neon' : '' }}">
                    Accueil
                </a>
                
                <!-- Dropdown Catégories -->
                <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <a href="{{ route('categories') }}" class="flex items-center font-display text-sm font-medium text-gray-300 hover:text-brand-neon transition-colors uppercase tracking-widest hover:border-b-2 hover:border-brand-neon py-2 focus:outline-none h-full">
                        Catégories
                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </a>
                    
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-2"
                         class="absolute left-0 mt-0 w-56 bg-brand-surface border border-white/10 rounded-xl shadow-2xl py-2 z-50 backdrop-blur-xl"
                         x-cloak>
                        @foreach(['consoles', 'monitors', 'son', 'claviers', 'chaises', 'souris', 'video-games', 'cartes-graphiques'] as $cat)
                            <a href="{{ route('produits.categorie', $cat) }}" class="block px-4 py-3 text-sm text-gray-300 hover:bg-white/5 hover:text-brand-neon transition-colors capitalize">
                                {{ ucfirst(str_replace('-', ' ', $cat)) }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('a_propos') }}" class="font-display text-sm font-medium text-gray-300 hover:text-brand-neon transition-colors uppercase tracking-widest hover:border-b-2 hover:border-brand-neon py-2 {{ request()->routeIs('a_propos') ? 'text-brand-neon border-b-2 border-brand-neon' : '' }}">
                    À Propos
                </a>
                <a href="{{ route('contact') }}" class="font-display text-sm font-medium text-gray-300 hover:text-brand-neon transition-colors uppercase tracking-widest hover:border-b-2 hover:border-brand-neon py-2 {{ request()->routeIs('contact') ? 'text-brand-neon border-b-2 border-brand-neon' : '' }}">
                    Contact
                </a>

                <a href="{{ route('cart.index') }}" class="relative font-display text-sm font-medium text-gray-300 hover:text-brand-neon transition-colors uppercase tracking-widest hover:border-b-2 hover:border-brand-neon py-2 {{ request()->routeIs('cart.index') ? 'text-brand-neon border-b-2 border-brand-neon' : '' }}">
                    Panier
                    @if(count(session('cart', [])) > 0)
                        <span class="absolute -top-1 -right-4 bg-red-600 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full shadow-[0_0_8px_rgba(255,0,0,0.5)]">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </a>
                
                <!-- Auth Check -->
                @guest
                    <a href="{{ route('login') }}" class="font-display text-sm font-bold text-white hover:text-brand-neon transition-colors uppercase tracking-widest border-2 border-white/20 hover:border-brand-neon rounded px-4 py-1 ml-4 relative overflow-hidden group">
                        <span class="relative z-10">SYSTEM ACCESS</span>
                        <div class="absolute inset-0 bg-brand-neon/20 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300"></div>
                    </a>
                @endguest

                @auth
                    <div class="relative group ml-4" x-data="{ portalOpen: false }" @mouseenter="portalOpen = true" @mouseleave="portalOpen = false">
                        <button class="flex items-center space-x-2 font-display text-sm font-bold {{ Auth::user()->isAdmin() ? 'text-brand-magenta border-brand-magenta' : 'text-brand-neon border-brand-neon' }} hover:text-white transition-colors uppercase tracking-widest border-2 hover:border-white rounded px-3 py-1 relative overflow-hidden">
                            <span>{{ Auth::user()->isAdmin() ? 'GOD PORTAL' : 'ANGEL PORTAL' }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <!-- Holographic Dropdown -->
                        <div x-show="portalOpen" 
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                x-transition:leave="transition ease-in duration-150"
                                class="absolute right-0 top-full mt-2 w-64 p-1 rounded-xl bg-gradient-to-b from-white/10 to-transparent backdrop-blur-xl border border-white/20 shadow-[0_0_30px_rgba(0,0,0,0.8)] z-50 overflow-hidden"
                                x-cloak>
                                
                            <div class="bg-black/80 rounded-lg p-2 relative">
                                <!-- Scanline Effect -->
                                <div class="absolute inset-0 pointer-events-none opacity-5" style="background: repeating-linear-gradient(0deg, transparent, transparent 2px, #fff 3px);"></div>
                                
                                <div class="px-4 py-3 border-b border-white/10 mb-2">
                                    <p class="text-[10px] text-gray-500 uppercase tracking-widest">Identity Verified</p>
                                    <p class="font-display text-white font-bold truncate">{{ Auth::user()->name }}</p>
                                </div>

                                @if(Auth::user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-sm text-brand-magenta hover:bg-brand-magenta/10 hover:text-white transition-colors rounded mb-1 group">
                                        <svg class="w-5 h-5 mr-3 group-hover:animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                                        <span class="uppercase tracking-wider">Dashboard</span>
                                    </a>
                                @endif

                                <a href="{{ route('orders.index') }}" class="flex items-center px-4 py-3 text-sm text-brand-neon hover:bg-brand-neon/10 hover:text-white transition-colors rounded mb-1 group">
                                    <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                    <span class="uppercase tracking-wider">Mission Logs</span>
                                </a>

                                <a href="{{ route('logout') }}" 
                                    class="flex items-center px-4 py-3 text-sm text-red-500 hover:bg-red-500/10 hover:text-red-400 transition-colors rounded mt-2 border-t border-white/5"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    <span class="uppercase tracking-wider">Disconnect</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Hidden Logout Form -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @endauth
            </div>

            <div class="md:hidden z-50 relative">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-white hover:text-brand-neon focus:outline-none transition-colors p-2">
                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform -translate-y-full"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         class="md:hidden fixed inset-0 bg-brand-dark/95 backdrop-blur-xl z-40 flex flex-col pt-32 px-6 space-y-6 overflow-y-auto"
         x-cloak>
         
         <a href="{{ route('home') }}" class="block text-center font-display text-2xl font-bold py-4 border-b border-white/10 hover:text-brand-neon {{ request()->routeIs('home', 'root') ? 'text-brand-neon' : 'text-white' }}">Accueil</a>
         
         <!-- Mobile Cats Split -->
         <div x-data="{ catOpen: false }" class="border-b border-white/10">
            <div class="flex items-center">
                <a href="{{ route('categories') }}" class="flex-grow text-center font-display text-2xl font-bold py-4 text-white hover:text-brand-neon transition-colors">
                    Catégories
                </a>
                <button @click="catOpen = !catOpen" class="p-4 text-white hover:text-brand-neon focus:outline-none border-l border-white/10">
                    <svg :class="{'rotate-180': catOpen}" class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
            </div>
            <div x-show="catOpen" x-collapse class="bg-black/20">
                @foreach(['consoles', 'monitors', 'son', 'claviers', 'chaises', 'souris', 'video-games', 'cartes-graphiques'] as $cat)
                    <a href="{{ route('produits.categorie', $cat) }}" class="block text-center py-3 text-lg text-gray-400 hover:text-brand-neon hover:bg-white/5 transition-colors capitalize">
                        {{ ucfirst(str_replace('-', ' ', $cat)) }}
                    </a>
                @endforeach
            </div>
         </div>
         
         <a href="{{ route('a_propos') }}" class="block text-center font-display text-2xl font-bold py-4 border-b border-white/10 hover:text-brand-neon {{ request()->routeIs('a_propos') ? 'text-brand-neon' : 'text-white' }}">À Propos</a>
         <a href="{{ route('contact') }}" class="block text-center font-display text-2xl font-bold py-4 border-b border-white/10 hover:text-brand-neon {{ request()->routeIs('contact') ? 'text-brand-neon' : 'text-white' }}">Contact</a>
         
         <!-- Mobile Cart -->
         <a href="{{ route('cart.index') }}" class="block text-center font-display text-2xl font-bold py-4 border-b border-white/10 hover:text-brand-neon {{ request()->routeIs('cart.index') ? 'text-brand-neon' : 'text-white' }}">
            Panier 
            @if(count(session('cart', [])) > 0)
                <span class="ml-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">{{ count(session('cart')) }}</span>
            @endif
         </a>
         
         <!-- Mobile Auth -->
         @guest
             <a href="{{ route('login') }}" class="block text-center font-display text-2xl font-bold py-4 border-b border-white/10 text-white hover:text-brand-neon">SYSTEM ACCESS</a>
         @endguest

         @auth
            @if(Auth::user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="block text-center font-display text-2xl font-bold py-4 border-b border-white/10 text-brand-magenta hover:text-brand-neon animate-pulse">GOD PORTAL</a>
            @else
                <div class="block text-center font-display text-2xl font-bold py-4 border-b border-white/10 text-brand-neon">ANGEL PORTAL</div>
            @endif
            
            <a href="{{ route('orders.index') }}" class="block text-center font-display text-xl font-bold py-4 border-b border-white/10 text-brand-neon hover:text-white">MISSION LOGS</a>
            
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block text-center font-display text-xl font-bold py-4 border-b border-white/10 text-red-500 hover:text-white">DISCONNECT</a>
         @endauth

         <!-- Mobile Footer Info -->
        <div class="mt-auto pb-10 text-center">
            <p class="text-gray-500 text-sm font-sans uppercase tracking-widest mb-4">Suivez-nous</p>
            <div class="flex justify-center space-x-8">
                <a href="#" class="text-gray-400 hover:text-brand-neon"><span class="sr-only">Twitter</span><svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/></svg></a>
                <a href="#" class="text-gray-400 hover:text-brand-magenta"><span class="sr-only">Instagram</span><svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772 4.902 4.902 0 011.772-1.153c.636-.247 1.363-.416 2.427-.465 1.067-.047 1.407-.06 3.808-.06h.63zm2.595 14.53a1.53 1.53 0 110-3.06 1.53 1.53 0 010 3.06zm-1.587-14c-2.67 0-3.001.01-4.053.058-1.048.048-1.762.207-2.386.45a3.72 3.72 0 00-1.348.879 3.72 3.72 0 00-.88 1.348c-.242.624-.402 1.338-.45 2.386-.047 1.052-.058 1.383-.058 4.053 0 2.67.01 3.001.058 4.053.048 1.048.207 1.762.45 2.386a3.72 3.72 0 00.88 1.348 3.72 3.72 0 001.348.879c.624.242 1.338.402 2.386.45 1.052.047 1.383.058 4.053.058 2.67 0 3.001-.01 4.053-.058 1.048-.048 1.762-.207 2.386-.45a3.72 3.72 0 001.348-.879 3.72 3.72 0 00.88-1.348c.242-.624.402-1.338.45-2.386.047-1.052.058-1.383.058-4.053 0-2.67-.01-3.001-.058-4.053-.048-1.048-.207-1.762-.45-2.386a3.72 3.72 0 00-.879-1.348 3.72 3.72 0 00-1.348-.88c-.624-.242-1.338-.402-2.386-.45-1.052-.047-1.383-.058-4.053-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.8a3.335 3.335 0 100 6.67 3.335 3.335 0 000-6.67z" clip-rule="evenodd"/></svg></a>
            </div>
        </div>
    </div>
</nav>