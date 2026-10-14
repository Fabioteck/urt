@extends('layouts.public')

@section('content')
<div class="relative bg-zinc-950 border-b border-zinc-900 py-32 px-4 text-center overflow-hidden">
    <!-- Interactive Particles Canvas -->
    <canvas id="particles" class="absolute inset-0 z-0 pointer-events-none"></canvas>

    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#dc2626_1px,transparent_1px)] [background-size:16px_16px] z-0"></div>
    <div class="relative max-w-4xl mx-auto space-y-6 z-10">
        <h1 class="text-5xl md:text-7xl font-black uppercase tracking-wider text-white">
            Underground <span class="text-red-600">Remind Tek</span>
        </h1>
        <p class="text-lg md:text-xl text-zinc-400 max-w-2xl mx-auto font-mono">
            Sound System Culture & Independent Electronic Music Collective.
        </p>
        <div class="flex justify-center gap-4 pt-4">
            <a href="{{ route('artists.index') }}" class="bg-red-600 text-white font-bold px-6 py-3 rounded uppercase tracking-wider hover:bg-red-700 transition">Artisti</a>
            <a href="{{ route('news.index') }}" class="border border-zinc-800 font-bold px-6 py-3 rounded uppercase tracking-wider hover:bg-zinc-900 transition">News & Eventi</a>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-24">
    <!-- Progetto Preview -->
    @if(isset($progettoPage))
        <div class="bg-zinc-950 border border-zinc-900 rounded-xl p-8 md:p-12 space-y-4">
            <h2 class="text-xs font-mono text-red-500 uppercase tracking-widest">Il Collettivo</h2>
            <h3 class="text-3xl font-black uppercase text-white">{{ $progettoPage->title }}</h3>
            <p class="text-zinc-400 leading-relaxed text-base">{{ Str::limit($progettoPage->content, 250) }}</p>
            <a href="{{ route('pages.show', 'progetto') }}" class="inline-block text-sm font-bold text-red-500 hover:underline pt-2">Leggi la nostra storia &rarr;</a>
        </div>
    @endif

    <!-- Artists Grid (4) -->
    <div>
        <div class="flex justify-between items-end mb-8 border-b border-zinc-900 pb-4">
            <h2 class="text-2xl font-black uppercase tracking-wider">Artisti in Evidenza</h2>
            <a href="{{ route('artists.index') }}" class="text-red-500 hover:underline text-sm font-bold uppercase">Tutti gli artisti &rarr;</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($artists as $artist)
                <div class="bg-zinc-950 border border-zinc-900 rounded-lg overflow-hidden text-center hover:border-red-600/50 transition p-6 space-y-4">
                    @if($artist->image)
                        <img src="{{ asset($artist->image) }}" alt="{{ $artist->name }}" class="w-32 h-32 mx-auto rounded-full object-cover border-2 border-red-600">
                    @else
                        <div class="w-32 h-32 mx-auto rounded-full bg-zinc-900 flex items-center justify-center text-zinc-600 font-bold font-mono">URT</div>
                    @endif
                    <div>
                        <h3 class="text-lg font-bold text-white">
                            <a href="{{ route('artists.show', $artist) }}" class="hover:text-red-500 transition">{{ $artist->name }}</a>
                        </h3>
                        <p class="text-xs text-red-500 font-mono uppercase tracking-wider mt-1">{{ $artist->role }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- News Grid (3) -->
    <div>
        <div class="flex justify-between items-end mb-8 border-b border-zinc-900 pb-4">
            <h2 class="text-2xl font-black uppercase tracking-wider">Ultime News</h2>
            <a href="{{ route('news.index') }}" class="text-red-500 hover:underline text-sm font-bold uppercase">Tutte le news &rarr;</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($latestNews as $item)
                <div class="bg-zinc-950 border border-zinc-900 rounded-lg overflow-hidden flex flex-col justify-between hover:border-red-600/50 transition">
                    <div>
                        @if($item->image)
                            <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-zinc-900 flex items-center justify-center text-zinc-700 font-bold font-mono">U.R.T. NEWS</div>
                        @endif
                        <div class="p-6 space-y-3">
                            <span class="text-xs text-red-500 font-mono">{{ $item->published_at?->format('d.m.Y') }}</span>
                            <h3 class="text-xl font-bold text-white hover:text-red-500 transition">
                                <a href="{{ route('news.show', $item) }}">{{ $item->title }}</a>
                            </h3>
                            <p class="text-zinc-400 text-sm">{{ $item->excerpt }}</p>
                        </div>
                    </div>
                    <div class="p-6 pt-0">
                        <a href="{{ route('news.show', $item) }}" class="text-sm font-bold text-red-500 hover:underline">Leggi tutto &rarr;</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const canvas = document.getElementById('particles');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');

        function resize() {
            canvas.width = canvas.parentElement.offsetWidth;
            canvas.height = canvas.parentElement.offsetHeight;
        }
        resize();
        window.addEventListener('resize', resize);

        const particlesArray = [];
        const numberOfParticles = 60;

        class Particle {
            constructor() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.size = Math.random() * 3 + 1;
                this.speedX = (Math.random() - 0.5) * 1.2;
                this.speedY = (Math.random() - 0.5) * 1.2;
            }
            update() {
                this.x += this.speedX;
                this.y += this.speedY;

                if (this.x < 0 || this.x > canvas.width) this.speedX = -this.speedX;
                if (this.y < 0 || this.y > canvas.height) this.speedY = -this.speedY;
            }
            draw() {
                ctx.fillStyle = 'rgba(220, 38, 38, 0.4)';
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fill();
            }
        }

        for (let i = 0; i < numberOfParticles; i++) {
            particlesArray.push(new Particle());
        }

        function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            for (let i = 0; i < particlesArray.length; i++) {
                particlesArray[i].update();
                particlesArray[i].draw();
            }
            requestAnimationFrame(animate);
        }
        animate();
    });
</script>
@endsection
