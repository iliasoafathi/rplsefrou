<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = Member::query()->active();

        // Search by name, position, bio
        if ($search = trim((string) $request->get('q'))) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('position', 'like', "%{$search}%")
                  ->orWhere('bio', 'like', "%{$search}%");
            });
        }

        // Optional filter by joined_at range
        if ($from = $request->get('from')) {
            $query->whereDate('joined_at', '>=', $from);
        }
        if ($to = $request->get('to')) {
            $query->whereDate('joined_at', '<=', $to);
        }

        $members = $query->orderBy('position')->get();
        return view('members.index', compact('members'));
    }
}
