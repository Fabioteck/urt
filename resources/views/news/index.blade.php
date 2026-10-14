@extends('layouts.public')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12">
    <div class="border-b border-zinc-900 pb-6">
        <h1 class="text-4xl font-black uppercase tracking-wider text-white">News & Eventi</h1>
        <p class="text-zinc-400 mt-2">Comunicazioni ufficiali, release e prossimi raduni.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($news as $item)
            <div class="bg-zinc-950 border border-zinc-900 rounded-lg overflow-hidden flex flex-col justify-between hover:border-red-600 transition">
                <div>
                    @if($item->image)
                        <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" class="w-full h-52 object-cover">
                    @else
                        <div class="w-full h-52 bg-zinc-900 flex items-center justify-center text-zinc-700 font-bold font-mono">U.R.T. NEWS</div>
                    @endif
                    <div class="p-6 space-y-3">
                        <span class="text-xs text-red-500 font-mono">{{ $item->published_at?->format('d.m.Y') }}</span>
                        <h2 class="text-xl font-bold text-white hover:text-red-500 transition">
                            <a href="{{ route('news.show', $item) }}">{{ $item->title }}</a>
                        </h2>
                        <p class="text-zinc-400 text-sm">{{ $item->excerpt }}</p>
                    </div>
                </div>
                <div class="p-6 pt-0">
                    <a href="{{ route('news.show', $item) }}" class="text-sm font-bold text-red-500 hover:underline">Leggi articolo &rarr;</a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="pt-6">
        {{ $news->links() }}
    </div>
</div>
@endsection
