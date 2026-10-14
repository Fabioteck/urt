@extends('layouts.public')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-16 space-y-8">
    <a href="{{ route('news.index') }}" class="text-sm font-bold text-zinc-400 hover:text-white">&larr; Torna alle news</a>

    <article class="space-y-6">
        <div class="space-y-2">
            <span class="text-sm text-red-500 font-mono">{{ $news->published_at?->format('d.m.Y') }}</span>
            <h1 class="text-3xl md:text-5xl font-black text-white uppercase">{{ $news->title }}</h1>
        </div>

        @if($news->image)
            <img src="{{ asset($news->image) }}" alt="{{ $news->title }}" class="w-full h-96 object-cover rounded-xl border border-zinc-900">
        @endif

        <div class="bg-zinc-950 border border-zinc-900 rounded-xl p-8 text-zinc-300 leading-relaxed text-lg space-y-6">
            {!! nl2br(e($news->content)) !!}
        </div>
    </article>
</div>
@endsection
