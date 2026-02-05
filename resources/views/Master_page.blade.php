<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMEZIANE-STORE | Gaming Gear</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700;900&family=Rajdhani:wght@300;500;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            dark: '#1a0b2e',
                            violet: '#bc13fe', // Keeping neon purple as requested for accents
                            neon: '#00f3ff', // Keeping neon cyan
                            magenta: '#bc13fe',
                            surface: '#2d1b4e', // Reverting surface or keeping semi-transparent? Step 71 had #2d1b4e. User wants "responsive" and "layout" fixed. Safe to revert to Step 71's surface for consistency with original look, but Glassmorphism was requested. I will try to blend them.
                        }
                    },
                    fontFamily: {
                        sans: ['Rajdhani', 'sans-serif'],
                        display: ['Orbitron', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background-color: #1a0b2e;
            color: #e2e8f0;
        }
        .neon-text {
            text-shadow: 0 0 10px rgba(0, 255, 255, 0.7);
        }
        .neon-border {
            box-shadow: 0 0 15px rgba(255, 0, 255, 0.3);
        }
    </style>
</head>
<body class="flex flex-col min-h-screen">

    @include('Menu')

    <main class="flex-grow container mx-auto px-4 py-8">
        @yield('content')
    </main>

    @include('Footer')

    <!-- Success Modal -->
    @if(session('show_modal'))
    <div x-data="{ open: true }" x-show="open" class="fixed inset-0 z-[100] flex items-center justify-center p-4" x-cloak>
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm transition-opacity" @click="open = false"></div>

        <!-- Modal Content -->
        <div class="relative bg-brand-surface border border-brand-neon/50 rounded-2xl shadow-[0_0_50px_rgba(0,243,255,0.2)] max-w-md w-full p-6 overflow-hidden transform transition-all animate-bounce-in">
            <!-- Neon Glow Effect -->
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-brand-neon to-transparent"></div>
            
            <div class="text-center">
                <!-- Icon -->
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-brand-neon/10 mb-4 border border-brand-neon/20 shadow-[0_0_15px_rgba(0,243,255,0.3)]">
                    <svg class="h-8 w-8 text-brand-neon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                
                <h3 class="text-2xl font-display font-bold text-white mb-2 tracking-wide">ARTIFACT SECURED</h3>
                <p class="text-gray-300 font-mono text-sm mb-6">
                    <span class="text-brand-magenta font-bold">{{ session('added_product_name') }}</span> has been added to your inventory.
                </p>

                <div class="flex flex-col space-y-3">
                    <a href="{{ route('cart.index') }}" class="w-full inline-flex justify-center items-center px-4 py-3 bg-brand-neon hover:bg-white text-black font-display font-bold rounded-lg transition-all shadow-[0_0_15px_rgba(0,243,255,0.4)] hover:shadow-[0_0_25px_rgba(255,255,255,0.6)]">
                        ACCESS INVENTORY
                    </a>
                    <button @click="open = false" class="w-full inline-flex justify-center items-center px-4 py-3 border border-white/10 hover:border-brand-magenta rounded-lg text-gray-400 hover:text-white font-display font-bold transition-colors">
                        CONTINUE SHOPPING
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

</body>
</html>
