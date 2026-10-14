@extends('layouts.public')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12">
    <div class="border-b border-zinc-900 pb-6">
        <h1 class="text-4xl font-black uppercase tracking-wider text-white">Artisti & Selecta</h1>
        <p class="text-zinc-400 mt-2">I DJ, producer e sound system builder del collettivo.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @foreach($artists as $artist)
            <div class="bg-zinc-950 border border-zinc-900 rounded-lg overflow-hidden p-6 text-center space-y-4 hover:border-red-600 transition">
                @if($artist->image)
                    <img src="{{ asset($artist->image) }}" alt="{{ $artist->name }}" class="w-36 h-36 mx-auto rounded-full object-cover border-2 border-red-600">
                @else
                    <div class="w-36 h-36 mx-auto rounded-full bg-zinc-900 flex items-center justify-center text-zinc-600 font-bold font-mono">URT</div>
                @endif
                <div>
                    <h2 class="text-xl font-bold text-white">
                        <a href="{{ route('artists.show', $artist) }}" class="hover:text-red-500 transition">{{ $artist->name }}</a>
                    </h2>
                    <p class="text-xs text-red-500 font-mono uppercase tracking-wider mt-1">{{ $artist->role }}</p>
                </div>
                <p class="text-zinc-400 text-sm line-clamp-3">{{ $artist->bio }}</p>
                <a href="{{ route('artists.show', $artist) }}" class="inline-block text-xs font-bold uppercase tracking-wider bg-zinc-900 px-4 py-2 rounded hover:bg-red-600 hover:text-white transition">Profilo Completo</a>
            </div>
        @endforeach
    </div>

    <div class="pt-6">
        {{ $artists->links() }}
    </div>
</div>
@endsection
