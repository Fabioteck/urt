<x-guest-layout>
    <div class="space-y-6">
        <div class="flex items-center justify-between border-b border-zinc-800 pb-4">
            <h1 class="font-mono text-lg font-bold text-white uppercase tracking-wider">MODIFICA ARTISTA</h1>
            <a href="{{ route('admin.artists.index') }}" class="font-mono text-xs text-gray-400 hover:text-white">← INDIETRO</a>
        </div>

        @if ($errors->any())
            <div class="p-3 bg-red-950/50 border border-red-800 rounded text-red-400 font-mono text-xs">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.artists.update', $artist) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block font-mono text-xs text-gray-300 uppercase tracking-wider mb-1">Nome</label>
                <input type="text" name="name" id="name" value="{{ old('name', $artist->name) }}" required class="w-full bg-black border border-zinc-800 rounded text-white font-mono text-sm px-3 py-2 focus:border-red-600 focus:ring-0">
            </div>

            <div>
                <label for="role" class="block font-mono text-xs text-gray-300 uppercase tracking-wider mb-1">Ruolo</label>
                <input type="text" name="role" id="role" value="{{ old('role', $artist->role) }}" required class="w-full bg-black border border-zinc-800 rounded text-white font-mono text-sm px-3 py-2 focus:border-red-600 focus:ring-0">
            </div>

            <div>
                <label for="bio" class="block font-mono text-xs text-gray-300 uppercase tracking-wider mb-1">Biografia</label>
                <textarea name="bio" id="bio" rows="5" required class="w-full bg-black border border-zinc-800 rounded text-white font-mono text-sm px-3 py-2 focus:border-red-600 focus:ring-0">{{ old('bio', $artist->bio) }}</textarea>
            </div>

            <div>
                <label for="image" class="block font-mono text-xs text-gray-300 uppercase tracking-wider mb-1">Immagine (Path relativo es. img/logo.jpg)</label>
                <input type="text" name="image" id="image" value="{{ old('image', $artist->image) }}" class="w-full bg-black border border-zinc-800 rounded text-white font-mono text-sm px-3 py-2 focus:border-red-600 focus:ring-0">
            </div>

            <div>
                <label for="social_links_json" class="block font-mono text-xs text-gray-300 uppercase tracking-wider mb-1">Social Links (JSON)</label>
                <textarea name="social_links_json" id="social_links_json" rows="3" class="w-full bg-black border border-zinc-800 rounded text-white font-mono text-sm px-3 py-2 focus:border-red-600 focus:ring-0">{{ old('social_links_json', $artist->social_links ? json_encode($artist->social_links) : '') }}</textarea>
            </div>

            <div class="flex justify-end pt-2">
                <button type="submit" class="font-mono text-xs bg-red-600 hover:bg-red-700 text-white uppercase px-4 py-2 rounded tracking-wider transition">
                    AGGIORNA ARTISTA
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
