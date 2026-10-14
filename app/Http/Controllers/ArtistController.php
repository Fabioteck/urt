<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::latest()->paginate(9);
        return view('artists.index', compact('artists'));
    }

    public function show(Artist $artist)
    {
        return view('artists.show', compact('artist'));
    }
}
