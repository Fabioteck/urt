<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\News;
use App\Models\StaticPage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $latestNews = News::published()->latest('published_at')->take(3)->get();
        $artists = Artist::take(4)->get();
        $progettoPage = StaticPage::where('key', 'progetto')->first();

        return view('home', compact('latestNews', 'artists', 'progettoPage'));
    }
}
