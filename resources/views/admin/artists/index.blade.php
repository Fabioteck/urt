<x-guest-layout>
    <div class="space-y-6">
        <div class="flex items-center justify-between border-b border-zinc-800 pb-4">
            <h1 class="font-mono text-lg font-bold text-white uppercase tracking-wider">GESTIONE ARTISTI</h1>
            <div class="space-x-3">
                <a href="{{ route('admin.dashboard') }}" class="font-mono text-xs text-gray-400 hover:text-white">← DASHBOARD</a>
                <a href="{{ route('admin.artists.create') }}" class="font-mono text-xs bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded uppercase tracking-wider transition">+ AGGIUNGI ARTISTA</a>
            </div>
        </div>

        @if (session('success'))
            <div class="p-3 bg-zinc-950 border border-green-900/50 text-green-400 font-mono text-xs rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-black border border-zinc-800 rounded-lg overflow-hidden">
            <div class="divide-y divide-zinc-800">
                @forelse($artists as $artist)
                    <div class="p-4 flex items-center justify-between hover:bg-zinc-950/50 transition">
                        <div>
                            <div class="font-mono text-sm font-bold text-white">{{ $artist->name }}</div>
                            <div class="font-mono text-xs text-red-500 mt-0.5">{{ $artist->role }}</div>
                        </div>
                        <div class="flex items-center space-x-3 font-mono text-xs">
                            <a href="{{ route('admin.artists.edit', $artist) }}" class="text-gray-300 hover:text-white px-2 py-1 bg-zinc-900 border border-zinc-800 rounded">MODIFICA</a>
                            <form action="{{ route('admin.artists.destroy', $artist) }}" method="POST" onsubmit="return confirm('Eliminare questo artista?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 px-2 py-1 bg-red-950/30 border border-red-900/50 rounded">ELIMINA</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center font-mono text-xs text-gray-500">Nessun artista trovato.</div>
                @endforelse
            </div>
        </div>

        @if(method_exists($artists, 'links'))
            <div class="mt-4">
                {{ $artists->links() }}
            </div>
        @endif
    </div>
</x-guest-layout>
