<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Activity;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured articles (latest 6 visible articles)
        $featuredArticles = Article::visible()->published()->latest('published_at')->take(6)->get();

        // Get upcoming or ongoing activities (next 6 visible activities)
        $upcomingActivities = Activity::visible()
            ->upcoming()
            ->orderBy('starts_at', 'asc')
            ->take(6)
            ->get();

        // Get counts for statistics
        $articlesCount = Article::visible()->count();
        $activitiesCount = Activity::visible()->count();

        return view('home', compact('featuredArticles', 'upcomingActivities', 'articlesCount', 'activitiesCount'));
    }
}
