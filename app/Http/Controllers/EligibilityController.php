<?php

namespace App\Http\Controllers;

use App\Models\Scheme;
use App\Models\Category;
use App\Models\State;
use Illuminate\Http\Request;

class EligibilityController extends Controller
{
    /**
     * Step 1: State selection welcome screen.
     */
    public function index()
    {
        $states = State::orderBy('is_central', 'desc')
            ->orderBy('name')
            ->get();

        return view('eligibility.index', compact('states'));
    }

    /**
     * Step 2: Category, age, income, occupation form.
     */
    public function step2(Request $request)
    {
        $validated = $request->validate([
            'state' => 'nullable|exists:states,id',
        ]);

        $categories = Category::orderBy('sort_order')->get();
        $states = State::orderBy('is_central', 'desc')
            ->orderBy('name')
            ->get();

        return view('eligibility.step2', compact('categories', 'states', 'validated'));
    }

    /**
     * Step 3: Match user answers to schemes and show results.
     */
    public function result(Request $request)
    {
        $data = $request->validate([
            'state' => 'nullable|exists:states,id',
            'category' => 'nullable|string',
            'age_group' => 'nullable|in:0-18,18-25,25-40,40-60,60+',
            'income' => 'nullable|in:0-1lac,1-2.5lac,2.5-5lac,5-10lac,10+lac',
            'occupation' => 'nullable|in:farming,student,private_job,govt_job,business,unemployed,retired',
            'caste' => 'nullable|in:general,sc,st,obc,ewb',
            'disability' => 'nullable|in:yes,no',
        ]);

        $query = Scheme::active()->with('category', 'state');

        if (!empty($data['state'])) {
            $query->where('state_id', $data['state']);
        }

        if (!empty($data['category'])) {
            $query->whereHas('category', fn($q) => $q->where('slug', $data['category']));
        }

        $schemes = $query->get();

        return view('eligibility.result', compact('schemes', 'data'));
    }
}
