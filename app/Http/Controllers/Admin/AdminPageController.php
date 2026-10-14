<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaticPage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminPageController extends Controller
{
    public function index()
    {
        $pages = StaticPage::all();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|string',
            'whatsapp_1' => 'nullable|url|max:255',
            'whatsapp_2' => 'nullable|url|max:255',
            'website' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'phone' => 'nullable|string|max:50',
        ]);

        $metaData = array_filter([
            'whatsapp_1' => $validated['whatsapp_1'] ?? null,
            'whatsapp_2' => $validated['whatsapp_2'] ?? null,
            'website' => $validated['website'] ?? null,
            'instagram' => $validated['instagram'] ?? null,
            'facebook' => $validated['facebook'] ?? null,
            'phone' => $validated['phone'] ?? null,
        ]);

        StaticPage::create([
            'key' => Str::slug($validated['title']),
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image' => $validated['image'] ?? null,
            'meta_data' => !empty($metaData) ? $metaData : null,
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Pagina statica creata con successo.');
    }

    public function edit(StaticPage $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, StaticPage $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|string',
            'whatsapp_1' => 'nullable|url|max:255',
            'whatsapp_2' => 'nullable|url|max:255',
            'website' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'phone' => 'nullable|string|max:50',
        ]);

        $metaData = array_filter([
            'whatsapp_1' => $validated['whatsapp_1'] ?? null,
            'whatsapp_2' => $validated['whatsapp_2'] ?? null,
            'website' => $validated['website'] ?? null,
            'instagram' => $validated['instagram'] ?? null,
            'facebook' => $validated['facebook'] ?? null,
            'phone' => $validated['phone'] ?? null,
        ]);

        $page->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image' => $validated['image'] ?? $page->image,
            'meta_data' => !empty($metaData) ? $metaData : null,
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Pagina statica aggiornata con successo.');
    }

    public function destroy(StaticPage $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Pagina statica eliminata con successo.');
    }
}
