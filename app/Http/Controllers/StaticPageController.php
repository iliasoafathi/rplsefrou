<?php

namespace App\Http\Controllers;

use App\Models\StaticPage;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    public function about()
    {
        $page = StaticPage::where('slug', 'about')->first();
        
        return view('pages.about', compact('page'));
    }

    public function contact()
    {
        $page = StaticPage::where('slug', 'contact')->first();
        
        return view('pages.contact', compact('page'));
    }

    public function show($slug)
    {
        $page = StaticPage::where('slug', $slug)->firstOrFail();
        
        return view('pages.show', compact('page'));
    }
}
