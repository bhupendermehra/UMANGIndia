<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Scheme;

class StateController extends Controller
{
    public function show(State $state)
    {
        $schemes = Scheme::active()
            ->where('state_id', $state->id)
            ->with('category')
            ->latest('published_at')
            ->paginate(20);

        $state->loadCount('schemes');

        return view('states.show', compact('state', 'schemes'));
    }
}
