<x-guest-layout>
    <!-- Quill.js CDN CSS -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />

    <div class="space-y-6">
        <div class="flex items-center justify-between border-b border-zinc-800 pb-4">
            <h1 class="font-mono text-lg font-bold text-white uppercase tracking-wider">MODIFICA PAGINA: {{ strtoupper($page->key) }}</h1>
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

        <form action="{{ route('admin.pages.update', $page) }}" method="POST" id="page-form" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block font-mono text-xs text-gray-300 uppercase tracking-wider mb-1">Titolo</label>
                <input type="text" name="title" id="title" value="{{ old('title', $page->title) }}" required class="w-full bg-black border border-zinc-800 rounded text-white font-mono text-sm px-3 py-2 focus:border-red-600 focus:ring-0">
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
                <textarea name="content" id="content" rows="10" required class="w-full bg-black border border-zinc-800 rounded text-white font-mono text-sm p-3 focus:border-red-600 focus:ring-0 hidden">{{ old('content', $page->content) }}</textarea>
            </div>

            <div class="flex justify-end pt-2">
                <button type="submit" class="font-mono text-xs bg-red-600 hover:bg-red-700 text-white uppercase px-4 py-2 rounded tracking-wider transition">
                    AGGIORNA PAGINA
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
                        ['link']
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
        });
    </script>
</x-guest-layout>
