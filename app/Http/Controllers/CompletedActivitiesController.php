<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class CompletedActivitiesController extends Controller
{
    public function index(Request $request)
    {
        $query = Activity::query()
            ->where('is_visible', true)
            ->where(function ($q) {
                $q->where(function ($qq) {
                    $qq->whereNotNull('ends_at')
                       ->where('ends_at', '<', now());
                })->orWhere(function ($qq) {
                    $qq->whereNull('ends_at')
                       ->where('starts_at', '<', now());
                });
            });

        if ($search = trim((string) $request->get('q'))) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($from = $request->get('from')) {
            $query->whereDate('starts_at', '>=', $from);
        }
        if ($to = $request->get('to')) {
            $query->whereDate('starts_at', '<=', $to);
        }

        $activities = $query->orderByRaw('COALESCE(ends_at, starts_at) DESC')->paginate(12)->withQueryString();

        return view('activities.completed', compact('activities'));
    }
}


