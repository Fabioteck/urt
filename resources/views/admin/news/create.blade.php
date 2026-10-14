<x-guest-layout>
    <div class="space-y-6">
        <div class="flex items-center justify-between border-b border-zinc-800 pb-4">
            <h1 class="font-mono text-lg font-bold text-white uppercase tracking-wider">NUOVA NEWS</h1>
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

        <form action="{{ route('admin.news.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="title" class="block font-mono text-xs text-gray-300 uppercase tracking-wider mb-1">Titolo</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required class="w-full bg-black border border-zinc-800 rounded text-white font-mono text-sm px-3 py-2 focus:border-red-600 focus:ring-0">
            </div>

            <div>
                <label for="excerpt" class="block font-mono text-xs text-gray-300 uppercase tracking-wider mb-1">Estratto</label>
                <input type="text" name="excerpt" id="excerpt" value="{{ old('excerpt') }}" class="w-full bg-black border border-zinc-800 rounded text-white font-mono text-sm px-3 py-2 focus:border-red-600 focus:ring-0">
            </div>

            <div>
                <label for="content" class="block font-mono text-xs text-gray-300 uppercase tracking-wider mb-1">Contenuto</label>
                <textarea name="content" id="content" rows="6" required class="w-full bg-black border border-zinc-800 rounded text-white font-mono text-sm px-3 py-2 focus:border-red-600 focus:ring-0">{{ old('content') }}</textarea>
            </div>

            <div>
                <label class="block font-mono text-xs text-gray-300 uppercase tracking-wider mb-1">Immagine Copertina</label>
                <input type="hidden" name="image" id="image_path_input" value="{{ old('image') }}">
                <input type="file" id="image_file_ajax" class="hidden" accept="image/*">
                
                <div class="flex items-center space-x-4">
                    <button type="button" id="upload_btn" class="font-mono text-xs bg-zinc-800 hover:bg-zinc-700 text-white px-3 py-2 rounded uppercase border border-zinc-700 transition">
                        CARICA IMMAGINE
                    </button>
                    <span id="upload_status" class="font-mono text-xs text-zinc-400">Nessun file selezionato</span>
                </div>

                <div id="image_preview_container" class="mt-3 {{ old('image') ? '' : 'hidden' }}">
                    <img id="image_preview" src="{{ old('image') ? asset(old('image')) : '' }}" alt="Preview" class="w-32 h-20 object-cover rounded border border-zinc-700">
                </div>
            </div>

            <div>
                <label for="published_at" class="block font-mono text-xs text-gray-300 uppercase tracking-wider mb-1">Data Pubblicazione</label>
                <input type="datetime-local" name="published_at" id="published_at" value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}" class="w-full bg-black border border-zinc-800 rounded text-white font-mono text-sm px-3 py-2 focus:border-red-600 focus:ring-0">
            </div>

            <div class="flex justify-end pt-2">
                <button type="submit" class="font-mono text-xs bg-red-600 hover:bg-red-700 text-white uppercase px-4 py-2 rounded tracking-wider transition">
                    SALVA NEWS
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const uploadBtn = document.getElementById('upload_btn');
            const fileInput = document.getElementById('image_file_ajax');
            const pathInput = document.getElementById('image_path_input');
            const statusSpan = document.getElementById('upload_status');
            const previewContainer = document.getElementById('image_preview_container');
            const previewImg = document.getElementById('image_preview');

            uploadBtn.addEventListener('click', function() {
                fileInput.click();
            });

            fileInput.addEventListener('change', function() {
                if (fileInput.files.length === 0) return;
                const file = fileInput.files[0];
                const formData = new FormData();
                formData.append('file', file);

                statusSpan.textContent = 'Caricamento in corso...';

                fetch('{{ route("admin.media.upload") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        pathInput.value = data.path;
                        previewImg.src = data.url;
                        previewContainer.classList.remove('hidden');
                        statusSpan.textContent = 'Caricamento completato!';
                    } else {
                        statusSpan.textContent = data.message || 'Errore durante il caricamento.';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    statusSpan.textContent = 'Errore di rete.';
                });
            });
        });
    </script>
</x-guest-layout>
