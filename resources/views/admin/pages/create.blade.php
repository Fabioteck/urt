<x-guest-layout>
    <!-- Quill.js CDN CSS -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />

    <div class="space-y-6">
        <div class="flex items-center justify-between border-b border-zinc-800 pb-4">
            <h1 class="font-mono text-lg font-bold text-white uppercase tracking-wider">CREA NUOVA PAGINA STATICA</h1>
            <a href="{{ route('admin.pages.index') }}" class="font-mono text-xs text-gray-400 hover:text-white">← INDIETRO</a>
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

        <form action="{{ route('admin.pages.store') }}" method="POST" id="page-form" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="block font-mono text-xs text-gray-300 uppercase tracking-wider mb-1">Titolo</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required class="w-full bg-black border border-zinc-800 rounded text-white font-mono text-sm px-3 py-2 focus:border-red-600 focus:ring-0">
            </div>

            <div>
                <label class="block font-mono text-xs text-gray-300 uppercase tracking-wider mb-1">Foto Copertina</label>
                <input type="hidden" name="image" id="image_path_input" value="{{ old('image') }}">
                <input type="file" id="image_file_ajax" class="hidden" accept="image/*">
                
                <div class="flex items-center space-x-4">
                    <button type="button" id="upload_btn" class="font-mono text-xs bg-zinc-800 hover:bg-zinc-700 text-white px-3 py-2 rounded uppercase border border-zinc-700 transition">
                        CARICA FOTO COPERTINA
                    </button>
                    <span id="upload_status" class="font-mono text-xs text-zinc-400">Nessun file selezionato</span>
                </div>

                <div id="image_preview_container" class="mt-3 {{ old('image') ? '' : 'hidden' }}">
                    <img id="image_preview" src="{{ old('image') ? asset(old('image')) : '' }}" alt="Preview" class="w-32 h-20 object-cover rounded border border-zinc-700">
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between mb-1">
                    <label class="block font-mono text-xs text-gray-300 uppercase tracking-wider">Contenuto</label>
                    <button type="button" id="toggle-source" class="font-mono text-[10px] bg-zinc-800 hover:bg-zinc-700 text-gray-300 px-2 py-1 rounded uppercase">
                        Sorgente HTML
                    </button>
                </div>

                <!-- Quill Editor Container -->
                <div id="editor-container" class="bg-zinc-900 border border-zinc-800 rounded text-white font-mono text-sm min-h-[250px]"></div>

                <!-- Raw HTML Textarea -->
                <textarea name="content" id="content" rows="10" required class="w-full bg-black border border-zinc-800 rounded text-white font-mono text-sm p-3 focus:border-red-600 focus:ring-0 hidden">{{ old('content') }}</textarea>
            </div>

            <div class="border-t border-zinc-800 pt-6 space-y-4">
                <h3 class="font-mono text-xs text-red-500 uppercase tracking-widest font-bold">LINK COMMUNITY & CONTATTI DELLA CREW</h3>
                
                <div>
                    <label for="whatsapp_1" class="block font-mono text-xs text-gray-300 uppercase tracking-wider mb-1">Link WhatsApp Community</label>
                    <input type="url" name="whatsapp_1" id="whatsapp_1" value="{{ old('whatsapp_1') }}" class="w-full bg-black border border-zinc-800 rounded text-white font-mono text-sm px-3 py-2 focus:border-red-600 focus:ring-0">
                </div>

                <div>
                    <label for="whatsapp_2" class="block font-mono text-xs text-gray-300 uppercase tracking-wider mb-1">Link WhatsApp Info</label>
                    <input type="url" name="whatsapp_2" id="whatsapp_2" value="{{ old('whatsapp_2') }}" class="w-full bg-black border border-zinc-800 rounded text-white font-mono text-sm px-3 py-2 focus:border-red-600 focus:ring-0">
                </div>

                <div>
                    <label for="website" class="block font-mono text-xs text-gray-300 uppercase tracking-wider mb-1">Sito Web Esterno</label>
                    <input type="url" name="website" id="website" value="{{ old('website') }}" class="w-full bg-black border border-zinc-800 rounded text-white font-mono text-sm px-3 py-2 focus:border-red-600 focus:ring-0">
                </div>

                <div>
                    <label for="instagram" class="block font-mono text-xs text-gray-300 uppercase tracking-wider mb-1">Profilo Instagram</label>
                    <input type="url" name="instagram" id="instagram" value="{{ old('instagram') }}" class="w-full bg-black border border-zinc-800 rounded text-white font-mono text-sm px-3 py-2 focus:border-red-600 focus:ring-0">
                </div>

                <div>
                    <label for="facebook" class="block font-mono text-xs text-gray-300 uppercase tracking-wider mb-1">Pagina Facebook</label>
                    <input type="url" name="facebook" id="facebook" value="{{ old('facebook') }}" class="w-full bg-black border border-zinc-800 rounded text-white font-mono text-sm px-3 py-2 focus:border-red-600 focus:ring-0">
                </div>

                <div>
                    <label for="phone" class="block font-mono text-xs text-gray-300 uppercase tracking-wider mb-1">Telefono</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="w-full bg-black border border-zinc-800 rounded text-white font-mono text-sm px-3 py-2 focus:border-red-600 focus:ring-0">
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="font-mono text-xs bg-red-600 hover:bg-red-700 text-white uppercase px-4 py-2 rounded tracking-wider transition">
                    SALVA PAGINA
                </button>
            </div>
        </form>
    </div>

    <!-- Quill.js CDN JS -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <style>
        .ql-toolbar.ql-snow {
            background-color: #18181b;
            border-color: #27272a !important;
            border-top-left-radius: 0.375rem;
            border-top-right-radius: 0.375rem;
        }
        .ql-container.ql-snow {
            background-color: #09090b;
            border-color: #27272a !important;
            border-bottom-left-radius: 0.375rem;
            border-bottom-right-radius: 0.375rem;
            color: #f4f4f5;
            font-family: inherit;
        }
        .ql-snow .ql-stroke { stroke: #a1a1aa; }
        .ql-snow .ql-fill { fill: #a1a1aa; }
        .ql-snow .ql-picker { color: #a1a1aa; }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var quill = new Quill('#editor-container', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote', 'code-block'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        ['link', 'image']
                    ]
                }
            });

            var contentInput = document.getElementById('content');
            quill.root.innerHTML = contentInput.value;

            var toggleBtn = document.getElementById('toggle-source');
            var editorContainer = document.getElementById('editor-container');
            var isSourceView = false;

            toggleBtn.addEventListener('click', function() {
                isSourceView = !isSourceView;
                if (isSourceView) {
                    contentInput.value = quill.root.innerHTML;
                    editorContainer.style.display = 'none';
                    contentInput.classList.remove('hidden');
                    toggleBtn.textContent = 'Editor Visivo';
                } else {
                    quill.root.innerHTML = contentInput.value;
                    contentInput.classList.add('hidden');
                    editorContainer.style.display = 'block';
                    toggleBtn.textContent = 'Sorgente HTML';
                }
            });

            var form = document.getElementById('page-form');
            form.addEventListener('submit', function() {
                if (!isSourceView) {
                    contentInput.value = quill.root.innerHTML;
                }
            });

            // Async Image Upload
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
