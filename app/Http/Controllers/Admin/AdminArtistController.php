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
            'soundcloud' => 'nullable|url|max:255',
            'spotify' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
        ]);

        $socialLinks = array_filter([
            'soundcloud' => $validated['soundcloud'] ?? null,
            'spotify' => $validated['spotify'] ?? null,
            'youtube' => $validated['youtube'] ?? null,
            'instagram' => $validated['instagram'] ?? null,
            'facebook' => $validated['facebook'] ?? null,
        ]);

        Artist::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'role' => $validated['role'],
            'bio' => $validated['bio'],
            'image' => $validated['image'] ?? null,
            'social_links' => !empty($socialLinks) ? $socialLinks : null,
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
            'soundcloud' => 'nullable|url|max:255',
            'spotify' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
        ]);

        $socialLinks = array_filter([
            'soundcloud' => $validated['soundcloud'] ?? null,
            'spotify' => $validated['spotify'] ?? null,
            'youtube' => $validated['youtube'] ?? null,
            'instagram' => $validated['instagram'] ?? null,
            'facebook' => $validated['facebook'] ?? null,
        ]);

        $artist->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'role' => $validated['role'],
            'bio' => $validated['bio'],
            'image' => $validated['image'] ?? $artist->image,
            'social_links' => !empty($socialLinks) ? $socialLinks : null,
        ]);

        return redirect()->route('admin.artists.index')->with('success', 'Artista aggiornato con successo.');
    }

    public function destroy(Artist $artist)
    {
        $artist->delete();
        return redirect()->route('admin.artists.index')->with('success', 'Artista eliminato con successo.');
    }
}
