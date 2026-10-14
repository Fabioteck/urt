<x-guest-layout>
    <div class="space-y-6">
        <div class="flex items-center justify-between border-b border-zinc-800 pb-4">
            <h1 class="font-mono text-lg font-bold text-white uppercase tracking-wider">MODIFICA NEWS</h1>
            <a href="{{ route('admin.news.index') }}" class="font-mono text-xs text-gray-400 hover:text-white">← INDIETRO</a>
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

        <form action="{{ route('admin.news.update', $news) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block font-mono text-xs text-gray-300 uppercase tracking-wider mb-1">Titolo</label>
                <input type="text" name="title" id="title" value="{{ old('title', $news->title) }}" required class="w-full bg-black border border-zinc-800 rounded text-white font-mono text-sm px-3 py-2 focus:border-red-600 focus:ring-0">
            </div>

            <div>
                <label for="excerpt" class="block font-mono text-xs text-gray-300 uppercase tracking-wider mb-1">Estratto</label>
                <input type="text" name="excerpt" id="excerpt" value="{{ old('excerpt', $news->excerpt) }}" class="w-full bg-black border border-zinc-800 rounded text-white font-mono text-sm px-3 py-2 focus:border-red-600 focus:ring-0">
            </div>

            <div>
                <label for="content" class="block font-mono text-xs text-gray-300 uppercase tracking-wider mb-1">Contenuto</label>
                <textarea name="content" id="content" rows="6" required class="w-full bg-black border border-zinc-800 rounded text-white font-mono text-sm px-3 py-2 focus:border-red-600 focus:ring-0">{{ old('content', $news->content) }}</textarea>
            </div>

            <div>
                <label for="image" class="block font-mono text-xs text-gray-300 uppercase tracking-wider mb-1">Immagine (Path relativo es. img/news.jpg)</label>
                <input type="text" name="image" id="image" value="{{ old('image', $news->image) }}" class="w-full bg-black border border-zinc-800 rounded text-white font-mono text-sm px-3 py-2 focus:border-red-600 focus:ring-0">
            </div>

            <div>
                <label for="published_at" class="block font-mono text-xs text-gray-300 uppercase tracking-wider mb-1">Data Pubblicazione</label>
                <input type="datetime-local" name="published_at" id="published_at" value="{{ old('published_at', $news->published_at ? $news->published_at->format('Y-m-d\TH:i') : '') }}" class="w-full bg-black border border-zinc-800 rounded text-white font-mono text-sm px-3 py-2 focus:border-red-600 focus:ring-0">
            </div>

            <div class="flex justify-end pt-2">
                <button type="submit" class="font-mono text-xs bg-red-600 hover:bg-red-700 text-white uppercase px-4 py-2 rounded tracking-wider transition">
                    AGGIORNA NEWS
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
