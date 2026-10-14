<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::latest()->paginate(10);
        return view('admin.artists.index', compact('artists'));
    }

    public function create()
    {
        return view('admin.artists.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'bio' => 'required|string',
            'image' => 'nullable|string',
            'social_links_json' => 'nullable|string',
        ]);

        $socialLinks = !empty($validated['social_links_json']) ? json_decode($validated['social_links_json'], true) : null;

        Artist::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'role' => $validated['role'],
            'bio' => $validated['bio'],
            'image' => $validated['image'] ?? null,
            'social_links' => $socialLinks,
        ]);

        return redirect()->route('admin.artists.index')->with('success', 'Artista creato con successo.');
    }

    public function edit(Artist $artist)
    {
        return view('admin.artists.edit', compact('artist'));
    }

    public function update(Request $request, Artist $artist)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'bio' => 'required|string',
            'image' => 'nullable|string',
            'social_links_json' => 'nullable|string',
        ]);

        $socialLinks = !empty($validated['social_links_json']) ? json_decode($validated['social_links_json'], true) : null;

        $artist->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'role' => $validated['role'],
            'bio' => $validated['bio'],
            'image' => $validated['image'] ?? $artist->image,
            'social_links' => $socialLinks,
        ]);

        return redirect()->route('admin.artists.index')->with('success', 'Artista aggiornato con successo.');
    }

    public function destroy(Artist $artist)
    {
        $artist->delete();
        return redirect()->route('admin.artists.index')->with('success', 'Artista eliminato con successo.');
    }
}
