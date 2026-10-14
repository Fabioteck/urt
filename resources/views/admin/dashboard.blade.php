<x-guest-layout>
    <div class="space-y-6">
        <div class="flex items-center justify-between border-b border-zinc-800 pb-4">
            <h1 class="font-mono text-xl font-bold text-white tracking-widest uppercase">PANNELLO DI CONTROLLO</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="font-mono text-xs uppercase text-red-500 hover:text-red-400 border border-red-900/50 bg-red-950/20 px-3 py-1.5 rounded transition">
                    LOGOUT
                </button>
            </form>
        </div>

        @if (session('success'))
            <div class="p-3 bg-zinc-950 border border-green-900/50 text-green-400 font-mono text-xs rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('admin.artists.index') }}" class="group block p-6 bg-black border border-zinc-800 rounded-lg hover:border-red-600 transition">
                <h2 class="font-mono text-lg font-bold text-white group-hover:text-red-500 mb-2 uppercase tracking-wide">GESTIONE ARTISTI</h2>
                <p class="font-mono text-xs text-gray-400">Aggiungi, modifica o rimuovi i membri e gli artisti del collettivo U.R.T.</p>
            </a>

            <a href="{{ route('admin.news.index') }}" class="group block p-6 bg-black border border-zinc-800 rounded-lg hover:border-red-600 transition">
                <h2 class="font-mono text-lg font-bold text-white group-hover:text-red-500 mb-2 uppercase tracking-wide">GESTIONE NEWS</h2>
                <p class="font-mono text-xs text-gray-400">Pubblica e gestisci comunicati, aggiornamenti e lanci ufficiali.</p>
            </a>
        </div>

        <div class="pt-4 border-t border-zinc-800 flex justify-between items-center text-xs font-mono text-gray-500">
            <span>URT SYSTEM v2.0</span>
            <a href="{{ route('home') }}" class="hover:text-white underline">TORNA AL SITO</a>
        </div>
    </div>
</x-guest-layout>
