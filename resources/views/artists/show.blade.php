@extends('layouts.public')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-16 space-y-10">
    <a href="{{ route('artists.index') }}" class="text-sm font-bold text-zinc-400 hover:text-white">&larr; Torna agli artisti</a>

    <div class="bg-zinc-950 border border-zinc-900 rounded-xl p-8 md:p-12 flex flex-col md:flex-row gap-8 items-center md:items-start shadow-xl">
        @if($artist->image)
            <img src="{{ asset($artist->image) }}" alt="{{ $artist->name }}" class="w-48 h-48 rounded-full object-cover border-4 border-red-600 flex-shrink-0">
        @else
            <div class="w-48 h-48 rounded-full bg-zinc-900 flex items-center justify-center text-zinc-600 font-bold font-mono flex-shrink-0">URT</div>
        @endif
        <div class="space-y-4 text-center md:text-left flex-grow">
            <h1 class="text-3xl md:text-4xl font-black text-white">{{ $artist->name }}</h1>
            <p class="text-red-500 font-mono uppercase tracking-wider text-sm">{{ $artist->role }}</p>
            <div class="text-zinc-300 leading-relaxed whitespace-pre-line text-base">
                {{ $artist->bio }}
            </div>

            @if($artist->social_links && is_array($artist->social_links))
                <div class="pt-6 flex flex-wrap justify-center md:justify-start gap-3">
                    @if(!empty($artist->social_links['soundcloud']))
                        <a href="{{ $artist->social_links['soundcloud'] }}" target="_blank" class="inline-flex items-center space-x-2 bg-zinc-900 border border-zinc-800 text-zinc-300 px-4 py-2 rounded text-xs font-mono uppercase tracking-wider hover:bg-red-600 hover:text-white transition">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M11.56 8.87V17h-2V8.87a3.5 3.5 0 1 1 2 0zM15 10v7h-2v-7a1.5 1.5 0 1 1 3 0zm4 2v5h-2v-5a1.5 1.5 0 1 1 3 0zM7 12v5H5v-5a2 2 0 1 1 4 0zm-6 2v3H3v-3a1 1 0 1 1 2 0z"/></svg>
                            <span>SoundCloud</span>
                        </a>
                    @endif

                    @if(!empty($artist->social_links['spotify']))
                        <a href="{{ $artist->social_links['spotify'] }}" target="_blank" class="inline-flex items-center space-x-2 bg-zinc-900 border border-zinc-800 text-zinc-300 px-4 py-2 rounded text-xs font-mono uppercase tracking-wider hover:bg-red-600 hover:text-white transition">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm4.58 14.42a.4.4 0 0 1-.55.13 11.23 11.23 0 0 0-6.28-1.89 12.38 12.38 0 0 0-3.66.56.4.4 0 0 1-.48-.26.4.4 0 0 1 .26-.48 13.2 13.2 0 0 1 3.94-.6 12.08 12.08 0 0 1 6.78 2.05.4.4 0 0 1 .13.51zm1.22-2.72a.5.5 0 0 1-.69.17 14.15 14.15 0 0 0-7.85-2.38 15.42 15.42 0 0 0-4.59.72.5.5 0 0 1-.59-.33.5.5 0 0 1 .33-.59 16.5 16.5 0 0 1 4.95-.78 15.22 15.22 0 0 1 8.44 2.56.5.5 0 0 1 .17.69zm.13-2.83a17.9 17.9 0 0 0-9.98-2.92 19.34 19.34 0 0 0-5.83.91.6.6 0 0 1-.7-.4.6.6 0 0 1 .4-.7 20.6 20.6 0 0 1 6.3-1 19.47 19.47 0 0 1 10.74 3.14.6.6 0 0 1 .2.82.6.6 0 0 1-.83.17z"/></svg>
                            <span>Spotify</span>
                        </a>
                    @endif

                    @if(!empty($artist->social_links['youtube']))
                        <a href="{{ $artist->social_links['youtube'] }}" target="_blank" class="inline-flex items-center space-x-2 bg-zinc-900 border border-zinc-800 text-zinc-300 px-4 py-2 rounded text-xs font-mono uppercase tracking-wider hover:bg-red-600 hover:text-white transition">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.4.6A3 3 0 0 0 .5 6.2 31.4 31.4 0 0 0 0 12a31.4 31.4 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.1c1.9.6 9.4.6 9.4.6s7.5 0 9.4-.6a3 3 0 0 0 2.1-2.1A31.4 31.4 0 0 0 24 12a31.4 31.4 0 0 0-.5-5.8zM9.5 15.5v-7l6.5 3.5-6.5 3.5z"/></svg>
                            <span>YouTube</span>
                        </a>
                    @endif

                    @if(!empty($artist->social_links['instagram']))
                        <a href="{{ $artist->social_links['instagram'] }}" target="_blank" class="inline-flex items-center space-x-2 bg-zinc-900 border border-zinc-800 text-zinc-300 px-4 py-2 rounded text-xs font-mono uppercase tracking-wider hover:bg-red-600 hover:text-white transition">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.2c3.2 0 3.6 0 4.8.1 3.2.1 4.7 1.6 4.8 4.8.1 1.2.1 1.6.1 4.8s0 3.6-.1 4.8c-.1 3.2-1.6 4.7-4.8 4.8-1.2.1-1.6.1-4.8.1s-3.6 0-4.8-.1c-3.2-.1-4.7-1.6-4.8-4.8-.1-1.2-.1-1.6-.1-4.8s0-3.6.1-4.8c.1-3.2 1.6-4.7 4.8-4.8 1.2-.1 1.6-.1 4.8-.1M12 0C8.7 0 8.3 0 7 0.1 2.7 0.3 0.3 2.7 0.1 7 0 8.3 0 8.7 0 12s0 3.7 0.1 5c0.2 4.3 2.6 6.7 6.9 6.9 1.3 0.1 1.7 0.1 5 0.1s3.7 0 5-0.1c4.3-0.2 6.7-2.6 6.9-6.9 0.1-1.3 0.1-1.7 0.1-5s0-3.7-0.1-5C23.7 2.7 21.3 0.3 17 0.1 15.7 0 15.3 0 12 0zm0 5.8a6.2 6.2 0 1 0 0 12.4 6.2 6.2 0 0 0 0-12.4zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.4-11.8a1.4 1.4 0 1 0 0 2.8 1.4 1.4 0 0 0 0-2.8z"/></svg>
                            <span>Instagram</span>
                        </a>
                    @endif

                    @if(!empty($artist->social_links['facebook']))
                        <a href="{{ $artist->social_links['facebook'] }}" target="_blank" class="inline-flex items-center space-x-2 bg-zinc-900 border border-zinc-800 text-zinc-300 px-4 py-2 rounded text-xs font-mono uppercase tracking-wider hover:bg-red-600 hover:text-white transition">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M22.7 0H1.3C.6 0 0 .6 0 1.3v21.4C0 23.4.6 24 1.3 24h11.5v-9.3H9.7V11h3.1V8.4c0-3.1 1.9-4.8 4.7-4.8 1.3 0 2.5.1 2.8.1v3.3h-1.9c-1.5 0-1.8.7-1.8 1.8V11h3.6l-.5 3.7h-3.1V24h6.5c.7 0 1.3-.6 1.3-1.3V1.3c0-.7-.6-1.3-1.3-1.3z"/></svg>
                            <span>Facebook</span>
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
