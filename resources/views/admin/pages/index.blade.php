<x-guest-layout>
    <div class="space-y-6">
        <div class="flex items-center justify-between border-b border-zinc-800 pb-4">
            <h1 class="font-mono text-lg font-bold text-white uppercase tracking-wider">GESTIONE PAGINE STATICHE</h1>
            <a href="{{ route('admin.dashboard') }}" class="font-mono text-xs text-gray-400 hover:text-white">← DASHBOARD</a>
        </div>

        @if (session('success'))
            <div class="p-3 bg-zinc-950 border border-green-900/50 text-green-400 font-mono text-xs rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @forelse($pages as $page)
                <div class="bg-black border border-zinc-800 rounded-lg p-6 flex flex-col justify-between space-y-4">
                    <div>
                        <span class="text-xs font-mono text-red-500 uppercase tracking-widest">KEY: {{ $page->key }}</span>
                        <h2 class="font-mono text-lg font-bold text-white mt-1">{{ $page->title }}</h2>
                        <p class="font-mono text-xs text-gray-400 mt-2 line-clamp-3">{{ strip_tags($page->content) }}</p>
                    </div>
                    <div class="pt-4 border-t border-zinc-900 flex justify-end">
                        <a href="{{ route('admin.pages.edit', $page) }}" class="font-mono text-xs bg-zinc-900 hover:bg-zinc-800 text-white border border-zinc-700 px-3 py-1.5 rounded uppercase transition">
                            [ Modifica Contenuto ]
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-2 p-6 text-center font-mono text-xs text-gray-500">Nessuna pagina trovata.</div>
            @endforelse
        </div>
    </div>
</x-guest-layout>
