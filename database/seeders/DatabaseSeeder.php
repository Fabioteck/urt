<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\StaticPage;
use App\Models\Artist;
use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('PRAGMA foreign_keys = OFF;');
        News::truncate();
        Artist::truncate();
        StaticPage::truncate();
        User::truncate();
        DB::statement('PRAGMA foreign_keys = ON;');

        // Utente Amministratore
        User::updateOrCreate(
            ['email' => 'admin@urt.art'],
            [
                'name' => 'Admin URT',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Pagine Statiche
        StaticPage::updateOrCreate(
            ['key' => 'progetto'],
            [
                'title' => 'IL PROGETTO U.R.T.',
                'content' => 'Underground Remind Tek. URT, dalle radici dei "pirati delle macchinette" pronti a colpire. In un\'era tecnologica, vogliamo fare la differenza portando un messaggio positivo e sano. Crediamo in ciò che facciamo, guidati da passione e dedizione totali. Pronti alla riscossa verso nuovi mondi, vi presentiamo UNDERGROUND REMIND TEKNO',
            ]
        );

        StaticPage::updateOrCreate(
            ['key' => 'contatti'],
            [
                'title' => 'CONTATTI & BOOKING',
                'content' => 'Per booking, collaborazioni sound system e informazioni sui nostri raduni clandestini, contattaci via email o sui nostri canali social ufficiali.',
            ]
        );

        // Artisti Reali
        Artist::updateOrCreate(
            ['slug' => 'tripmentaltek'],
            [
                'name' => 'TRIPMENTALTEK',
                'role' => 'DJ / Producer / Founder',
                'bio' => 'Produttore musicale dal 2025, in arte TRIPMENTALTEK. Il nome nasce dall’unione di tre concetti che definiscono l\'identità artistica: Trip, Mental e Tek. Un nome che rappresenta un viaggio interiore, in cui la musica diventa un’esperienza capace di attraversare mente, corpo ed emozioni. Il mio approccio alla tekno non è soltanto musicale: è una ricerca continua di energia, libertà e connessione. Ogni set è pensato come un percorso in evoluzione, fatto di ritmi ipnotici, bassi profondi e atmosfere immersive che accompagnano il pubblico in un’esperienza collettiva, senza barriere. Founder di URT promuove la cultura underground attraverso il rispetto, la condivisione e la passione per il suono libero.',
                'image' => 'img/logo.jpg',
                'social_links' => [
                    'soundcloud' => 'https://soundcloud.com',
                    'instagram' => 'https://instagram.com'
                ]
            ]
        );

        Artist::updateOrCreate(
            ['slug' => 'rinascitek'],
            [
                'name' => 'RINASCITEK',
                'role' => 'DJ / Producer',
                'bio' => 'DJ e producer nel collettivo. Attivo nel mixaggio dal 2013, nel 2023 ha iniziato a produrre tracce focalizzandosi sulla Tekno Tribe, caratterizzata da un\'energia travolgente.',
                'image' => 'img/rinascitek.jpg',
                'social_links' => null
            ]
        );

        Artist::updateOrCreate(
            ['slug' => 'fabiotek'],
            [
                'name' => 'FabioTek',
                'role' => 'DJ / Producer / Live Performer',
                'bio' => 'DJ, producer e live performer con un background da polistrumentista. Attivo dal 1995, fonde istinto analogico e rigore tecnico nei suoi live-set utilizzando hardware puro (come Elektron e sintetizzatori modulari).',
                'image' => 'img/fabiotek.jpg',
                'social_links' => null
            ]
        );

        Artist::updateOrCreate(
            ['slug' => 'rebecca'],
            [
                'name' => 'Rebecca',
                'role' => 'Performer / Dancer',
                'bio' => 'Definita la Power Girl del gruppo, partecipa dei progetti come ballerina e performer.',
                'image' => 'img/rebecca.jpg',
                'social_links' => null
            ]
        );

        // News Reali
        News::updateOrCreate(
            ['slug' => 'sonic-collective-launch'],
            [
                'title' => 'Sonic Collective Launch',
                'excerpt' => 'U.R.T. — Sonic Collective — Est. 2024',
                'content' => 'Costruiamo frequenze essenziali, architetture ritmiche pure e paesaggi sonori oltre il confine.',
                'image' => 'img/news-launch.jpg',
                'published_at' => now()
            ]
        );
    }
}
