@extends('Master_page')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-display font-bold text-transparent bg-clip-text bg-gradient-to-r from-brand-neon to-brand-magenta mb-8 uppercase tracking-widest glitch-text" data-text="MISSION LOGS">
        MISSION LOGS
    </h1>

    @if(session('success'))
        <div class="bg-brand-neon/10 border border-brand-neon text-brand-neon px-4 py-3 rounded relative mb-4">
            <strong class="font-bold">SUCCESS:</strong> {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($orders as $order)
            <div class="bg-brand-surface border border-white/10 rounded-xl p-6 relative overflow-hidden group hover:border-brand-neon transition-colors duration-300">
                <div class="absolute top-0 right-0 p-4">
                    <span class="inline-block px-3 py-1 rounded border {{ $order->status == 'PENDING' ? 'text-yellow-400 border-yellow-400 bg-yellow-400/10' : 'text-green-400 border-green-400 bg-green-400/10' }} font-mono text-xs font-bold tracking-widest uppercase">
                        {{ $order->status }}
                    </span>
                </div>
                
                <h3 class="text-xl font-display font-bold text-white mb-2">MISSION #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h3>
                <p class="text-gray-500 text-sm font-mono mb-4">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                
                <div class="space-y-2 mb-6">
                    @foreach($order->products->take(3) as $product)
                        <div class="flex justify-between text-sm text-gray-400">
                            <span>{{ $product->nom }}</span>
                            <span class="text-gray-600">x{{ $product->pivot->quantity }}</span>
                        </div>
                    @endforeach
                    @if($order->products->count() > 3)
                        <div class="text-xs text-gray-600 italic">+ {{ $order->products->count() - 3 }} legacy artifacts</div>
                    @endif
                </div>

                <div class="flex justify-between items-end border-t border-white/10 pt-4">
                    <div>
                        <div class="text-xs text-gray-500 uppercase tracking-widest">Total Value</div>
                        <div class="text-2xl font-mono font-bold text-brand-magenta">{{ number_format($order->total_price, 2) }} €</div>
                    </div>
                    
                    @if($order->status == 'PENDING')
                        <div x-data="{ openDanger: false }">
                            <button @click="openDanger = true" class="group relative px-5 py-2 overflow-hidden rounded bg-red-900/20 border border-red-500/30 hover:border-red-500 transition-all duration-300 hover:shadow-[0_0_20px_rgba(239,68,68,0.4)]">
                                <!-- Animated Background Scan -->
                                <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-red-500/20 to-transparent transform -translate-x-full group-hover:translate-x-full transition-transform duration-700 ease-in-out"></div>
                                
                                <div class="flex items-center space-x-2 relative z-10">
                                    <span class="text-[10px] font-display font-bold uppercase tracking-[0.2em] text-red-500 group-hover:text-white transition-colors duration-300">
                                        INITIALIZE PURGE
                                    </span>
                                    <svg class="w-4 h-4 text-red-500 group-hover:text-white transition-colors duration-300 group-hover:rotate-12 transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                            </button>

                            <!-- Danger Modal -->
                            <div x-show="openDanger" class="fixed inset-0 z-[100] flex items-center justify-center p-4" x-cloak>
                                <div class="absolute inset-0 bg-black/90 backdrop-blur-md transition-opacity" @click="openDanger = false"></div>
                                
                                <div class="relative bg-brand-surface border border-red-500 rounded-xl p-8 max-w-sm w-full text-center shadow-[0_0_50px_rgba(255,0,0,0.3)] transform transition-all animate-shake">
                                    <h3 class="text-xl font-display font-bold text-red-500 mb-2 tracking-widest">CRITICAL WARNING</h3>
                                    <p class="text-gray-300 text-sm mb-6">Are you sure you want to abort Mission #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}? This action cannot be undone.</p>
                                    
                                    <form action="{{ route('orders.cancel', $order->id) }}" method="POST" class="space-y-3">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded uppercase tracking-widest transition-colors shadow-lg">
                                            CONFIRM ABORT
                                        </button>
                                        <button type="button" @click="openDanger = false" class="w-full py-3 border border-white/10 text-gray-400 hover:text-white uppercase tracking-widest rounded transition-colors">
                                            CANCEL
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                
                <div class="absolute inset-0 border-2 border-brand-neon opacity-0 group-hover:opacity-10 pointer-events-none rounded-xl transition-opacity"></div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center">
                 <h2 class="text-2xl font-display font-bold text-gray-600">NO MISSIONS ON RECORD</h2>
                 <a href="{{ route('home') }}" class="text-brand-neon hover:text-white mt-4 inline-block font-display uppercase tracking-widest border-b border-brand-neon hover:border-white transition-colors">Start New Mission</a>
            </div>
        @endforelse
    </div>
</div>
@endsection
