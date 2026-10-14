# U.R.T. — Underground Remind Tek Platform

Benvenuto nella repository ufficiale di **U.R.T. (Underground Remind Tek)**, un collettivo sonoro (*Sonic Collective*) fondato nel **2024** e composto da musicisti, producer, DJ e tecnici del suono dedicati alla cultura underground e alla musica tekno.

Questo progetto nasce dall'esigenza di effettuare un porting completo da un sito web statico in HTML/CSS a una **Web Application dinamica, modulare e scalabile**, sviluppata interamente in ambiente di produzione via SSH. L'intero codice è rilasciato in modalità aperta per supportare lo sviluppo e la condivisione all'interno della scena underground.

---

## 🛠️ Stack Tecnico & Architettura

L'infrastruttura è stata ingegnerizzata per essere estremamente leggera, veloce da mantenere e ottimizzata per la visualizzazione immediata da dispositivi mobile, riducendo al minimo il consumo di risorse sul server.

*   **Framework Backend:** Laravel 12 / 13 (Struttura nativa senza API esterne)
*   **Linguaggio:** PHP 8.3 / 8.4
*   **Database:** SQLite (Engine snello basato su file, ideale per transazioni rapide e zero overhead di memoria)
*   **Web Server:** Apache con modulo `mod_php` e `mod_rewrite` attivo per l'ottimizzazione dei percorsi interni
*   **Motore di Validazione & Auth:** Laravel Breeze (Riscritto interamente con estensione Blade nativa)
*   **Frontend & Styling:** Tailwind CSS & Vite (Compilazione asset Rolldown in produzione)
*   **Identità Visiva:** Tema *Total Dark Underground* (bg-black, text-zinc, accenti rosso/monocromatico) ed effetto canvas interattivo a particelle fluttuanti nell'Hero.

---

## 📦 Moduli & Funzionalità Sviluppate

L'applicazione è strutturata in modo modulare per consentire futuri inserimenti di servizi (es. playlist audio o download multimediali) senza dover riscrivere il core del codice.

### 1. Area Pubblica (Frontend Dinamico)
*   **Home, Artisti, News:** Interfacce collegate direttamente alle tabelle del database tramite Eloquent ORM.
*   **SEO & Routing Pulito:** Utilizzo esclusivo di `slug` e chiavi testuali univoche negli URL pubblici (`/artisti/{slug}`, `/news/{slug}`). Gli ID numerici incrementali del database non vengono mai esposti all'utente.

### 2. Area Amministrativa (Pannello CRUD Protetto)
*   **Autenticazione Sicura:** Gestione degli accessi, sessioni e protezione delle rotte tramite i middleware nativi di Laravel Breeze, allineati al database in modalità *file session*.
*   **CRUD Artisti & News:** Interfacce di gestione complete per l'inserimento, la modifica e la rimozione fisica dei record dal database SQLite.
*   **Gestione Pagine Statiche (Progetto & Contatti):** Integrazione dell'editor visuale WYSIWYG **Quill.js** con switch in tempo reale per la visualizzazione del codice HTML grezzo, permettendo la formattazione avanzata dei testi direttamente da smartphone.
*   **Motore di Upload Centralizzato (MediaController):** Modulo isolato per il caricamento di file sul disco pubblico di sistema (`public/storage`). Prevede una validazione rigida con limite massimo a **2 MB** per garantire alte performance su reti mobili e supporta estensioni multimediali (immagini) e documentali (PDF).

---

## ⚡ Installazione & Configurazione Rapida

Se desideri clonare il progetto in locale o eseguire il deploy su un altro server Linux, segui questi passaggi da terminale:

```bash
# 1. Clona il repository e installa le dipendenze
git clone https://github.com
cd urt
composer install
npm install && npm run build

# 2. Configura l'ambiente
cp .env.example .env
php artisan key:generate

# 3. Inizializza il Database SQLite
touch database/database.sqlite
php artisan migrate:fresh --seed

# 4. Collega lo storage multimediale
php artisan storage:link

# 5. Ottimizza la cache di produzione
php artisan optimize
```

### Note sui Permessi (Ambiente Apache Linux)
Per garantire il corretto funzionamento dei form e dell'upload dei file in produzione con SQLite, assicurati che l'utente del server web (`www-data`) abbia i diritti di scrittura sulle cartelle critiche:
```bash
sudo chown -R www-data:www-data /var/www/html/urt
sudo chmod -R 775 storage bootstrap/cache database
```

---
*U.R.T. — Sound System Culture & Independent Electronic Music Collective — Est. 2024*
