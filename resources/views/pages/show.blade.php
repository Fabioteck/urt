@extends('layouts.public')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-16 space-y-8">
    <div class="border-b border-zinc-900 pb-6">
        <h1 class="text-4xl font-black uppercase tracking-wider text-white">{{ $page->title }}</h1>
    </div>

    <div class="bg-zinc-950 border border-zinc-900 rounded-xl p-8 text-zinc-300 leading-relaxed text-lg space-y-6">
        {!! nl2br(e($page->content)) !!}

        @if($page->key === 'contatti')
            <div class="mt-8 pt-8 border-t border-zinc-900">
                <p class="text-sm uppercase font-mono text-zinc-500">Email Ufficiale / Booking</p>
                <a href="mailto:booking@urt.art" class="text-2xl font-black text-red-600 hover:underline">booking@urt.art</a>
            </div>
        @endif
    </div>
</div>
@endsection
