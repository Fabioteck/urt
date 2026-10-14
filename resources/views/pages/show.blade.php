@extends('layouts.public')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-16 space-y-10">
    <div class="border-b border-zinc-900 pb-6 space-y-4">
        <h1 class="text-4xl md:text-5xl font-black uppercase tracking-wider text-white">{{ $page->title }}</h1>
    </div>

    @if($page->image)
        <div class="rounded-xl overflow-hidden border border-zinc-900 shadow-2xl">
            <img src="{{ asset($page->image) }}" alt="{{ $page->title }}" class="w-full h-96 object-cover">
        </div>
    @endif

    <div class="bg-zinc-950 border border-zinc-900 rounded-xl p-8 md:p-12 text-zinc-300 leading-relaxed text-lg space-y-6 shadow-xl">
        {!! $page->content !!}

        @if(!empty($page->meta_data) && is_array($page->meta_data))
            <div class="mt-12 pt-8 border-t border-zinc-900 space-y-8 font-mono">
                @if(!empty($page->meta_data['phone']))
                    <div>
                        <p class="text-xs text-red-500 uppercase tracking-widest mb-1">Telefono</p>
                        <a href="tel:{{ $page->meta_data['phone'] }}" class="text-xl font-bold text-white hover:text-red-500 transition">{{ $page->meta_data['phone'] }}</a>
                    </div>
                @endif

                @if(!empty($page->meta_data['whatsapp_1']) || !empty($page->meta_data['whatsapp_2']))
                    <div class="space-y-3">
                        <p class="text-xs text-red-500 uppercase tracking-widest">WhatsApp & Community</p>
                        <div class="flex flex-wrap gap-4">
                            @if(!empty($page->meta_data['whatsapp_1']))
                                <a href="{{ $page->meta_data['whatsapp_1'] }}" target="_blank" class="inline-flex items-center space-x-2 bg-red-600 hover:bg-red-700 text-white px-5 py-3 rounded text-sm uppercase tracking-wider transition font-bold shadow-lg">
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                <span>WhatsApp Community</span>
                            </a>
                        @endif
                        @if(!empty($page->meta_data['whatsapp_2']))
                            <a href="{{ $page->meta_data['whatsapp_2'] }}" target="_blank" class="inline-flex items-center space-x-2 bg-zinc-900 border border-zinc-800 text-zinc-300 px-5 py-3 rounded text-sm uppercase tracking-wider transition hover:bg-zinc-800">
                                <span>WhatsApp Info</span>
                            </a>
                        @endif
                    </div>
                </div>
            @endif

            @if(!empty($page->meta_data['website']) || !empty($page->meta_data['instagram']) || !empty($page->meta_data['facebook']))
                <div class="space-y-3 pt-2">
                    <p class="text-xs text-red-500 uppercase tracking-widest">Canali Social & Web</p>
                    <div class="flex flex-wrap gap-3">
                        @if(!empty($page->meta_data['website']))
                            <a href="{{ $page->meta_data['website'] }}" target="_blank" class="bg-zinc-900 border border-zinc-800 text-zinc-300 px-4 py-2 rounded text-xs uppercase tracking-wider hover:bg-red-600 hover:text-white transition">
                                Sito Web
                            </a>
                        @endif
                        @if(!empty($page->meta_data['instagram']))
                            <a href="{{ $page->meta_data['instagram'] }}" target="_blank" class="bg-zinc-900 border border-zinc-800 text-zinc-300 px-4 py-2 rounded text-xs uppercase tracking-wider hover:bg-red-600 hover:text-white transition">
                                Instagram
                            </a>
                        @endif
                        @if(!empty($page->meta_data['facebook']))
                            <a href="{{ $page->meta_data['facebook'] }}" target="_blank" class="bg-zinc-900 border border-zinc-800 text-zinc-300 px-4 py-2 rounded text-xs uppercase tracking-wider hover:bg-red-600 hover:text-white transition">
                                Facebook
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>
@endsection
