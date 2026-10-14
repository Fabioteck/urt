<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaticPage;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function index()
    {
        $pages = StaticPage::all();
        return view('admin.pages.index', compact('pages'));
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
        ]);

        $page->update($validated);

        return redirect()->route('admin.pages.index')->with('success', 'Pagina statica aggiornata con successo.');
    }
}
