@extends('layouts.public')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-16 space-y-10">
    <a href="{{ route('artists.index') }}" class="text-sm font-bold text-zinc-400 hover:text-white">&larr; Torna agli artisti</a>

    <div class="bg-zinc-950 border border-zinc-900 rounded-xl p-8 md:p-12 flex flex-col md:flex-row gap-8 items-center md:items-start">
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
            @if($artist->social_links)
                <div class="pt-4 flex justify-center md:justify-start gap-4">
                    @foreach($artist->social_links as $platform => $url)
                        <a href="{{ $url }}" target="_blank" class="bg-zinc-900 text-zinc-300 px-4 py-2 rounded text-xs font-bold uppercase hover:bg-red-600 hover:text-white transition">{{ ucfirst($platform) }}</a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
