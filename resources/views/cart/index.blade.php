@extends('Master_page')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-display font-bold text-transparent bg-clip-text bg-gradient-to-r from-brand-neon to-brand-magenta mb-8 uppercase tracking-widest glitch-text" data-text="INVENTORY">
        SYSTEM INVENTORY
    </h1>

    @if(session('success'))
        <div class="bg-brand-neon/10 border border-brand-neon text-brand-neon px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">SYSTEM ALERT:</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-500/10 border border-red-500 text-red-500 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">ERROR:</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    @if(count($cart) > 0)
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto rounded-xl border border-white/10 shadow-[0_0_20px_rgba(0,0,0,0.5)] backdrop-blur-md bg-brand-surface">
            <table class="min-w-full text-left">
                <thead class="bg-black/40 text-brand-neon font-display uppercase tracking-wider text-sm border-b border-white/10">
                    <tr>
                        <th class="px-6 py-4">Artifact</th>
                        <th class="px-6 py-4">Price</th>
                        <th class="px-6 py-4">Quantity</th>
                        <th class="px-6 py-4">Subtotal</th>
                        <th class="px-6 py-4">Eject</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach($cart as $id => $details)
                    <tr class="hover:bg-brand-neon/5 transition-colors duration-200 group">
                        <td class="px-6 py-4 flex items-center space-x-4">
                            @if(isset($details['image']))
                                <div class="w-16 h-16 rounded overflow-hidden border border-white/20 group-hover:border-brand-neon transition-colors">
                                    <img src="{{ $details['image'] }}" alt="{{ $details['name'] }}" class="w-full h-full object-cover">
                                </div>
                            @endif
                            <span class="font-bold text-white group-hover:text-brand-neon transition-colors">{{ $details['name'] }}</span>
                        </td>
                        <td class="px-6 py-4 font-mono text-gray-300">{{ number_format($details['price'], 2) }} €</td>
                        <td class="px-6 py-4">
                           <!-- AJAX update could be used here, but for simplicity using a small form or just input that submits on change logic if JS added, 
                                but context asked for update(Request $request). I'll adding a simple form or input. 
                                User Requirement: "Quantity inputs must be styled dark." -->
                           <input type="number" value="{{ $details['quantity'] }}" 
                                  class="w-16 bg-black/50 border border-white/20 rounded text-center text-white focus:border-brand-neon focus:ring-1 focus:ring-brand-neon outline-none"
                                  hx-patch="{{ route('cart.update') }}"
                                  hx-vals='{"id": "{{ $id }}"}'
                                  name="quantity"
                                  min="1"
                                  onchange="this.dispatchEvent(new CustomEvent('change-qty', {detail: {id: {{ $id }}, qty: this.value}}))"
                                  >
                                  <!-- Fallback update via JS or separate update needed if no htake/alpine. I'll add a simple script below for update trigger or just link/form. 
                                       Given 'Generate the complete code', I will make it work. I'll use a form for update or just rely on 'update' route being called. 
                                       To be robust without complex JS, I'll wrap in form? No, table nesting forms is bad.
                                       I will add a small update button or use JS. I'll use a simple JS fetch at bottom. -->
                        </td>
                         <td class="px-6 py-4 font-mono text-brand-magenta font-bold">{{ number_format($details['price'] * $details['quantity'], 2) }} €</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('cart.remove', $id) }}" class="text-gray-500 hover:text-red-500 transition-colors transform hover:scale-110 block">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden space-y-4">
            @foreach($cart as $id => $details)
            <div class="bg-brand-surface border border-white/10 rounded-xl p-4 shadow-lg backdrop-blur-md relative overflow-hidden group">
                <!-- Neon Accent -->
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-brand-neon/50"></div>
                
                <div class="flex items-start space-x-4">
                    <!-- Image -->
                    <div class="w-24 h-24 flex-shrink-0 rounded-lg overflow-hidden border border-white/10">
                         @if(isset($details['image']))
                            <img src="{{ $details['image'] }}" alt="{{ $details['name'] }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-brand-dark flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Details -->
                    <div class="flex-grow min-w-0">
                        <div class="flex justify-between items-start">
                            <h3 class="text-white font-bold font-display truncate pr-2">{{ $details['name'] }}</h3>
                            <a href="{{ route('cart.remove', $id) }}" class="text-gray-500 hover:text-red-500 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </a>
                        </div>
                        
                        <p class="text-brand-magenta font-mono font-bold mt-1">{{ number_format($details['price'], 2) }} €</p>
                        
                        <div class="flex items-center justify-between mt-4">
                            <div class="flex items-center space-x-2">
                                <span class="text-xs text-gray-400 uppercase tracking-wider font-display">Qty</span>
                                <input type="number" value="{{ $details['quantity'] }}" 
                                      class="w-16 bg-black/50 border border-white/20 rounded text-center text-white focus:border-brand-neon focus:ring-1 focus:ring-brand-neon outline-none py-1"
                                      hx-patch="{{ route('cart.update') }}"
                                      hx-vals='{"id": "{{ $id }}"}'
                                      name="quantity"
                                      min="1"
                                      onchange="this.dispatchEvent(new CustomEvent('change-qty', {detail: {id: {{ $id }}, qty: this.value}}))"
                                      >
                            </div>
                            <div class="text-right">
                                <div class="text-[10px] text-gray-500 uppercase tracking-widest mb-0.5">Subtotal</div>
                                <div class="text-white font-mono font-bold">{{ number_format($details['price'] * $details['quantity'], 2) }} €</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8 relative p-1 rounded-2xl bg-gradient-to-r from-brand-neon/20 via-brand-magenta/20 to-brand-neon/20 animate-pulse-slow">
            <div class="bg-black/90 backdrop-blur-xl p-6 rounded-xl border border-white/10 flex flex-col md:flex-row justify-between items-center relative overflow-hidden group">
                
                <!-- Background Grid Effect -->
                <div class="absolute inset-0 opacity-10" style="background-image: linear-gradient(rgba(0, 243, 255, 0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(0, 243, 255, 0.1) 1px, transparent 1px); background-size: 20px 20px;"></div>

                <!-- Left: Clear Command -->
                <a href="{{ route('cart.clear') }}" class="relative z-10 flex items-center space-x-2 text-red-500 hover:text-red-400 transition-all group/clear mb-6 md:mb-0 order-2 md:order-1 px-4 py-2 hover:bg-red-500/10 rounded cursor-pointer">
                    <svg class="w-5 h-5 transition-transform group-hover/clear:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    <span class="font-display text-sm tracking-widest uppercase border-b border-transparent group-hover/clear:border-red-500">PURGE SYSTEM</span>
                </a>
                
                <!-- Right: Total & Checkout -->
                <div class="flex flex-col items-center md:items-end relative z-10 order-1 md:order-2 w-full md:w-auto">
                    <div class="flex items-end mb-6 space-x-4">
                        <div class="text-right hidden md:block">
                            <div class="text-[10px] text-brand-neon uppercase tracking-[0.2em] mb-1">Total Power Required</div>
                            <div class="h-1 w-full bg-brand-neon/30 rounded-full overflow-hidden">
                                <div class="h-full bg-brand-neon w-2/3 animate-pulse"></div>
                            </div>
                        </div>
                        <div class="text-4xl sm:text-5xl font-bold font-display text-white text-shadow-neon tracking-tighter">
                            {{ number_format($total, 2) }} <span class="text-xl text-brand-magenta">€</span>
                        </div>
                    </div>
                    
                    <a href="{{ route('checkout.process') }}" class="w-full md:w-auto relative group overflow-hidden rounded-lg">
                        <!-- Button Glow -->
                        <div class="absolute -inset-1 bg-gradient-to-r from-brand-neon to-brand-magenta opacity-70 blur group-hover:opacity-100 transition duration-200"></div>
                        
                        <!-- Button Content -->
                        <div class="relative px-8 py-4 bg-black rounded-lg flex items-center justify-center space-x-4 leading-none transition duration-200 group-hover:bg-black/80">
                            <span class="font-display font-black text-xl text-white tracking-widest uppercase group-hover:text-brand-neon transition-colors">
                                INITIALIZE CHECKOUT
                            </span>
                            <svg class="w-6 h-6 text-brand-magenta group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Simple Script for Quantity Update -->
        <script>
            document.querySelectorAll('input[name="quantity"]').forEach(input => {
                input.addEventListener('change', function() {
                    const id = this.getAttribute('onchange').match(/id: (\d+)/)[1];
                    const qty = this.value;
                    fetch('{{ route("cart.update") }}', {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ id: id, quantity: qty })
                    }).then(() => window.location.reload());
                });
            });
        </script>

    @else
        <div class="flex flex-col items-center justify-center py-20 text-center space-y-6">
            <div class="w-32 h-32 rounded-full bg-brand-dark border border-white/5 flex items-center justify-center shadow-[0_0_30px_rgba(0,0,0,0.5)] relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-brand-neon/5 to-transparent animate-spin-slow"></div>
                <svg class="w-16 h-16 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <h2 class="text-3xl font-display font-bold text-gray-500">VOID DETECTED</h2>
            <p class="font-mono text-brand-neon">INVENTORY EMPTY</p>
            <a href="{{ route('home') }}" class="mt-8 px-8 py-3 bg-white/5 border border-white/10 hover:border-brand-neon hover:text-brand-neon text-gray-300 transition-all font-display rounded uppercase tracking-widest">
                Return to Base
            </a>
        </div>
    @endif
</div>
@endsection
