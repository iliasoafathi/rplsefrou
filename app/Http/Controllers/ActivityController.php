<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $query = Activity::query()->where('is_visible', true);

        // Search
        if ($search = trim((string) $request->get('q'))) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Status filter: upcoming | past | all (default all)
        $status = $request->get('status');
        if ($status === 'upcoming') {
            $query->where(function ($q) {
                $q->whereDate('starts_at', '>=', now()->startOfDay())
                  ->orWhere(function ($q2) {
                      $q2->whereNotNull('ends_at')
                         ->where('ends_at', '>=', now());
                  });
            });
        } elseif ($status === 'past') {
            $query->where('starts_at', '<', now());
        }

        // Date range filters
        if ($from = $request->get('from')) {
            $query->whereDate('starts_at', '>=', $from);
        }
        if ($to = $request->get('to')) {
            $query->whereDate('starts_at', '<=', $to);
        }

        // Sorting: default upcoming first by date asc, otherwise recent first
        if ($status === 'past') {
            $query->orderBy('starts_at', 'desc');
        } else {
            $query->orderBy('starts_at', 'asc');
        }

        $activities = $query->paginate(12)->withQueryString();

        return view('activities.index', compact('activities'));
    }

    public function show($slug)
    {
        $activity = Activity::where('slug', $slug)
            ->where('is_visible', true)
            ->firstOrFail();

        // Get related activities (upcoming activities)
        $relatedActivities = Activity::where('is_visible', true)
            ->where('id', '!=', $activity->id)
            ->where('starts_at', '>=', now())
            ->orderBy('starts_at', 'asc')
            ->limit(4)
            ->get();

        return view('activities.show', compact('activity', 'relatedActivities'));
    }
}
