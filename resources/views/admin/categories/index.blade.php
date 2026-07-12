@extends('admin.layouts.app')

@section('title', 'Manage Categories')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Categories</h1>
        <p class="text-gray-500 text-sm">{{ $categories->count() }} total categories</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2.5 rounded-lg text-sm font-medium flex items-center gap-2 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add Category
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-5 py-3 text-left font-semibold text-gray-600">Icon</th>
                    <th class="px-5 py-3 text-left font-semibold text-gray-600">Name</th>
                    <th class="px-5 py-3 text-left font-semibold text-gray-600">Name (Hindi)</th>
                    <th class="px-5 py-3 text-left font-semibold text-gray-600">Slug</th>
                    <th class="px-5 py-3 text-left font-semibold text-gray-600">Schemes</th>
                    <th class="px-5 py-3 text-left font-semibold text-gray-600">Sort</th>
                    <th class="px-5 py-3 text-right font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($categories as $category)
                <tr class="hover:bg-gray-50">
                    <td class="px-5 py-3 text-2xl">{{ $category->icon }}</td>
                    <td class="px-5 py-3 font-medium text-gray-800">{{ $category->name }}</td>
                    <td class="px-5 py-3 text-gray-500">{{ $category->name_hi ?? '—' }}</td>
                    <td class="px-5 py-3 text-gray-400 text-xs">{{ $category->slug }}</td>
                    <td class="px-5 py-3 text-gray-500">{{ $category->schemes_count }}</td>
                    <td class="px-5 py-3 text-gray-500">{{ $category->sort_order }}</td>
                    <td class="px-5 py-3 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="text-primary-600 hover:text-primary-700 text-xs font-medium">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-medium">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-5 py-12 text-center text-gray-400">No categories found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
