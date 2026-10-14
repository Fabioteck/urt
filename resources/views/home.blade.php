@extends('layouts.public')

@section('content')
<div class="relative bg-transparent min-h-[85vh] py-32 md:py-48 px-4 flex flex-col items-center justify-center text-center overflow-hidden">
    <div class="relative max-w-4xl mx-auto space-y-8 z-10">
        <h1 class="text-5xl md:text-7xl lg:text-8xl font-black uppercase tracking-wider text-white mb-6">
            Underground <span class="text-red-600">Remind Tek</span>
        </h1>
        <p class="text-lg md:text-2xl text-zinc-400 max-w-2xl mx-auto font-mono">
            Sound System Culture & Independent Electronic Music Collective.
        </p>
        <div class="flex flex-wrap justify-center gap-4 pt-6">
            <a href="{{ route('artists.index') }}" class="bg-red-600 text-white font-bold px-8 py-4 rounded uppercase tracking-wider hover:bg-red-700 transition font-mono">Artisti</a>
            <a href="{{ route('news.index') }}" class="border border-zinc-800 font-bold px-8 py-4 rounded uppercase tracking-wider hover:bg-zinc-900 transition font-mono">News & Eventi</a>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32 space-y-28 md:space-y-36">
    <!-- Progetto Preview -->
    @if(isset($progettoPage))
        <div id="project" class="bg-zinc-950/90 backdrop-blur border border-zinc-900 rounded-xl p-8 md:p-16 space-y-6">
            <h2 class="text-xs font-mono text-red-500 uppercase tracking-widest">Il Collettivo</h2>
            <h3 class="text-3xl md:text-5xl font-black uppercase text-white">{{ $progettoPage->title }}</h3>
            <p class="text-zinc-400 leading-relaxed text-base md:text-lg">{{ Str::limit($progettoPage->content, 320) }}</p>
            <a href="{{ route('pages.show', 'progetto') }}" class="inline-block text-sm font-bold text-red-500 hover:underline pt-3 font-mono">Leggi la nostra storia &rarr;</a>
        </div>
    @endif

    <!-- Artists Grid (4) -->
    <div id="artists">
        <div class="flex justify-between items-end mb-12 border-b border-zinc-900 pb-4">
            <h2 class="text-2xl md:text-4xl font-black uppercase tracking-wider">Artisti in Evidenza</h2>
            <a href="{{ route('artists.index') }}" class="text-red-500 hover:underline text-sm font-bold uppercase font-mono">Tutti gli artisti &rarr;</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
            @foreach($artists as $artist)
                <div class="bg-zinc-950/90 backdrop-blur border border-zinc-900 rounded-xl overflow-hidden text-center hover:border-red-600/50 transition p-8 space-y-5">
                    @if($artist->image)
                        <img src="{{ asset($artist->image) }}" alt="{{ $artist->name }}" class="w-36 h-36 mx-auto rounded-full object-cover border-2 border-red-600 shadow-lg">
                    @else
                        <div class="w-36 h-36 mx-auto rounded-full bg-zinc-900 flex items-center justify-center text-zinc-600 font-bold font-mono">URT</div>
                    @endif
                    <div class="space-y-2">
                        <h3 class="text-xl font-bold text-white">
                            <a href="{{ route('artists.show', $artist) }}" class="hover:text-red-500 transition">{{ $artist->name }}</a>
                        </h3>
                        <p class="text-xs text-red-500 font-mono uppercase tracking-wider">{{ $artist->role }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- News Grid (3) -->
    <div id="news">
        <div class="flex justify-between items-end mb-12 border-b border-zinc-900 pb-4">
            <h2 class="text-2xl md:text-4xl font-black uppercase tracking-wider">Ultime News</h2>
            <a href="{{ route('news.index') }}" class="text-red-500 hover:underline text-sm font-bold uppercase font-mono">Tutte le news &rarr;</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($latestNews as $item)
                <div class="bg-zinc-950/90 backdrop-blur border border-zinc-900 rounded-xl overflow-hidden flex flex-col justify-between hover:border-red-600/50 transition shadow-lg">
                    <div>
                        @if($item->image)
                            <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" class="w-full h-56 object-cover">
                        @else
                            <div class="w-full h-56 bg-zinc-900 flex items-center justify-center text-zinc-700 font-bold font-mono">U.R.T. NEWS</div>
                        @endif
                        <div class="p-8 space-y-4">
                            <span class="text-xs text-red-500 font-mono">{{ $item->published_at?->format('d.m.Y') }}</span>
                            <h3 class="text-2xl font-bold text-white hover:text-red-500 transition">
                                <a href="{{ route('news.show', $item) }}">{{ $item->title }}</a>
                            </h3>
                            <p class="text-zinc-400 text-base leading-relaxed">{{ $item->excerpt }}</p>
                        </div>
                    </div>
                    <div class="p-8 pt-0">
                        <a href="{{ route('news.show', $item) }}" class="text-sm font-bold text-red-500 hover:underline font-mono">Leggi tutto &rarr;</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
