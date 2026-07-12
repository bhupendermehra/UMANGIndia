<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Scheme;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SchemeController extends Controller
{
    public function index(Request $request)
    {
        $query = Scheme::with('category', 'state');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $schemes = $query->latest()->paginate(20)->withQueryString();
        $categories = Category::orderBy('sort_order')->get();

        return view('admin.schemes.index', compact('schemes', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('sort_order')->get();
        $states = State::orderBy('name')->get();

        return view('admin.schemes.create', compact('categories', 'states'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_hi' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'state_id' => 'nullable|exists:states,id',
            'short_description' => 'required|string|max:500',
            'short_description_hi' => 'nullable|string|max:500',
            'content' => 'required|string',
            'content_hi' => 'nullable|string',
            'eligibility' => 'nullable|string',
            'eligibility_hi' => 'nullable|string',
            'benefits' => 'nullable|string',
            'benefits_hi' => 'nullable|string',
            'application_process' => 'nullable|string',
            'application_process_hi' => 'nullable|string',
            'required_documents' => 'nullable|string',
            'required_documents_hi' => 'nullable|string',
            'official_website' => 'nullable|url|max:500',
            'application_deadline' => 'nullable|date',
            'status' => 'required|in:active,upcoming,closed',
            'is_featured' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_title_hi' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_description_hi' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['published_at'] = now();
        $validated['is_featured'] = $request->boolean('is_featured');

        Scheme::create($validated);

        return redirect()->route('admin.schemes.index')
            ->with('success', 'Scheme created successfully.');
    }

    public function edit(Scheme $scheme)
    {
        $categories = Category::orderBy('sort_order')->get();
        $states = State::orderBy('name')->get();

        return view('admin.schemes.edit', compact('scheme', 'categories', 'states'));
    }

    public function update(Request $request, Scheme $scheme)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_hi' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'state_id' => 'nullable|exists:states,id',
            'short_description' => 'required|string|max:500',
            'short_description_hi' => 'nullable|string|max:500',
            'content' => 'required|string',
            'content_hi' => 'nullable|string',
            'eligibility' => 'nullable|string',
            'eligibility_hi' => 'nullable|string',
            'benefits' => 'nullable|string',
            'benefits_hi' => 'nullable|string',
            'application_process' => 'nullable|string',
            'application_process_hi' => 'nullable|string',
            'required_documents' => 'nullable|string',
            'required_documents_hi' => 'nullable|string',
            'official_website' => 'nullable|url|max:500',
            'application_deadline' => 'nullable|date',
            'status' => 'required|in:active,upcoming,closed',
            'is_featured' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_title_hi' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_description_hi' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');

        // Update slug only if title changed
        if ($scheme->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $scheme->update($validated);

        return redirect()->route('admin.schemes.index')
            ->with('success', 'Scheme updated successfully.');
    }

    public function destroy(Scheme $scheme)
    {
        $scheme->delete();

        return redirect()->route('admin.schemes.index')
            ->with('success', 'Scheme deleted successfully.');
    }
}
