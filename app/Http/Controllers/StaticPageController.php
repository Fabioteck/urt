<?php

namespace App\Http\Controllers;

use App\Models\StaticPage;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    public function show(StaticPage $page)
    {
        return view('pages.show', compact('page'));
    }
}
