@extends('Master_page')

@section('content')
<div class="max-w-2xl mx-auto">
    {{-- Header du formulaire --}}
    <div class="text-center mb-10">
        <h1 class="font-display font-bold text-4xl text-white mb-2">CONTACTEZ <span class="text-brand-neon">NOUS</span></h1>
        <p class="text-gray-400">Une question sur votre setup ? Besoin d'un conseil ?</p>
    </div>

    {{-- La Carte Cyberpunk --}}
    <div class="bg-brand-surface p-8 rounded-xl border border-white/10 shadow-[0_0_30px_rgba(67,56,202,0.15)] relative overflow-hidden">
        {{-- Effets de flou (Orbs) --}}
        <div class="absolute top-0 right-0 w-32 h-32 bg-brand-magenta blur-[80px] opacity-20"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-brand-neon blur-[80px] opacity-20"></div>

        {{-- 🟢 LOGIQUE AJOUTÉE : Message de Succès style Néon --}}
        @if(session('success'))
            <div class="mb-6 p-4 rounded border border-brand-neon bg-brand-neon/10 text-brand-neon text-center font-display font-bold uppercase tracking-widest shadow-[0_0_15px_rgba(0,243,255,0.2)] animate-pulse">
                ⚡ {{ session('success') }}
            </div>
        @endif

        {{-- 🟢 LOGIQUE AJOUTÉE : Route + Method + CSRF --}}
        <form action="{{ route('transmission.send') }}" method="POST" class="relative z-10 space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Input: Nom (Non traité par le backend actuel mais gardé pour le style UI) --}}
                <div class="space-y-2">
                    <label class="text-sm font-display font-bold text-gray-300 uppercase tracking-wider">Nom du Joueur</label>
                    <input type="text" name="name" class="w-full bg-brand-dark border border-white/10 rounded p-3 text-white focus:border-brand-neon focus:outline-none focus:shadow-[0_0_10px_rgba(0,255,255,0.3)] transition-all placeholder-gray-600" placeholder="Votre pseudo">
                </div>

                {{-- Input: Email (Connecté au Backend: name="email") --}}
                <div class="space-y-2">
                    <label class="text-sm font-display font-bold text-gray-300 uppercase tracking-wider">Email</label>
                    <input type="email" name="email" required class="w-full bg-brand-dark border border-white/10 rounded p-3 text-white focus:border-brand-neon focus:outline-none focus:shadow-[0_0_10px_rgba(0,255,255,0.3)] transition-all placeholder-gray-600" placeholder="email@exemple.com">
                </div>
            </div>

            {{-- Input: Sujet (Connecté au Backend: name="subject") --}}
            <div class="space-y-2">
                <label class="text-sm font-display font-bold text-gray-300 uppercase tracking-wider">Sujet</label>
                {{-- J'ai gardé ton Select car c'est plus joli, et le backend accepte une string --}}
                <select name="subject" class="w-full bg-brand-dark border border-white/10 rounded p-3 text-white focus:border-brand-magenta focus:outline-none transition-all">
                    <option value="Information Produit">Information Produit</option>
                    <option value="Suivi de Commande">Suivi de Commande</option>
                    <option value="Support Technique">Support Technique</option>
                    <option value="Partenariat">Partenariat</option>
                    <option value="Autre">Autre</option>
                </select>
            </div>

            {{-- Input: Message (Connecté au Backend: name="message") --}}
            <div class="space-y-2">
                <label class="text-sm font-display font-bold text-gray-300 uppercase tracking-wider">Message</label>
                <textarea name="message" rows="5" required class="w-full bg-brand-dark border border-white/10 rounded p-3 text-white focus:border-brand-neon focus:outline-none focus:shadow-[0_0_10px_rgba(0,255,255,0.3)] transition-all placeholder-gray-600" placeholder="Écrivez votre message ici..."></textarea>
            </div>

            {{-- Bouton Submit --}}
            <button type="submit" class="w-full bg-gradient-to-r from-brand-violet to-brand-magenta text-white font-display font-bold py-4 rounded shadow-lg hover:shadow-[0_0_20px_rgba(240,0,255,0.4)] transform hover:-translate-y-1 transition-all uppercase tracking-widest">
                Envoyer le message
            </button>
        </form>
    </div>

    {{-- Footer Info --}}
    <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
        <div class="p-4 rounded border border-white/5 bg-white/5">
            <div class="text-brand-neon mb-2 text-xl">📍</div>
            <p class="text-sm text-gray-300">Tanger, Maroc</p>
        </div>
        <div class="p-4 rounded border border-white/5 bg-white/5">
            <div class="text-brand-magenta mb-2 text-xl">✉️</div>
            <p class="text-sm text-gray-300">contact@ameziane.store</p>
        </div>
        <div class="p-4 rounded border border-white/5 bg-white/5">
            <div class="text-brand-neon mb-2 text-xl">📞</div>
            <p class="text-sm text-gray-300">+212 6 79 14 15 40</p>
        </div>
    </div>
</div>
@endsection