@extends('admin.layouts.app')

@section('title', 'Manage Schemes')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Schemes</h1>
        <p class="text-gray-500 text-sm">{{ $schemes->total() }} total schemes</p>
    </div>
    <a href="{{ route('admin.schemes.create') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2.5 rounded-lg text-sm font-medium flex items-center gap-2 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add Scheme
    </a>
</div>

<!-- Filters -->
<div class="bg-white rounded-xl p-4 shadow-sm border border-gray-200 mb-6">
    <h2 class="text-sm font-semibold text-gray-700 mb-3">Filters</h2>
    <form method="GET" class="flex flex-wrap gap-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search schemes..."
            class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 flex-1 min-w-[200px]">
        <select name="category_id" class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 min-w-[160px]">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->icon }} {{ $cat->name }}</option>
            @endforeach
        </select>
        <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary-500 min-w-[160px]">
            <option value="">All Status</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="upcoming" {{ request('status') == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
            <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
        </select>
        <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded-lg text-sm font-medium">Filter</button>
        <a href="{{ route('admin.schemes.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-600 hover:bg-slate-50">Clear</a>
    </form>
</div>

<!-- Table -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="sticky top-0 bg-slate-50 border-b border-gray-200 z-10">
                <tr>
                    <th class="px-4 py-2.5 text-left font-semibold text-gray-600 text-sm">Title</th>
                    <th class="px-4 py-2.5 text-left font-semibold text-gray-600 text-sm">Category</th>
                    <th class="px-4 py-2.5 text-left font-semibold text-gray-600 text-sm">Status</th>
                    <th class="px-4 py-2.5 text-left font-semibold text-gray-600 text-sm">Views</th>
                    <th class="px-4 py-2.5 text-left font-semibold text-gray-600 text-sm">Featured</th>
                    <th class="px-4 py-2.5 text-right font-semibold text-gray-600 text-sm">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($schemes as $scheme)
                <tr class="hover:bg-slate-50">
                    <td class="px-4 py-2.5">
                        <div class="font-medium text-gray-800">{{ $scheme->title }}</div>
                        <div class="text-xs text-gray-400">/yojana/{{ $scheme->slug }}</div>
                    </td>
                    <td class="px-4 py-2.5">
                        <span class="bg-primary-50 text-primary-600 text-xs px-2 py-1 rounded-full">{{ $scheme->category->name }}</span>
                    </td>
                    <td class="px-4 py-2.5">
                        @if($scheme->status === 'active')
                            <span class="px-2 py-0.5 text-xs rounded-full bg-green-100 text-green-700">Active</span>
                        @elseif($scheme->status === 'upcoming')
                            <span class="px-2 py-0.5 text-xs rounded-full bg-yellow-100 text-yellow-700">Upcoming</span>
                        @else
                            <span class="px-2 py-0.5 text-xs rounded-full bg-red-100 text-red-700">Closed</span>
                        @endif
                    </td>
                    <td class="px-4 py-2.5 text-gray-500">{{ number_format($scheme->views) }}</td>
                    <td class="px-4 py-2.5">
                        @if($scheme->is_featured)
                            <span class="text-saffron-600">★</span>
                        @else
                            <span class="text-gray-300">☆</span>
                        @endif
                    </td>
                    <td class="px-4 py-2.5 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.schemes.edit', $scheme) }}" class="text-primary-600 hover:text-primary-700 text-xs font-medium">Edit</a>
                            <a href="{{ route('schemes.show', $scheme) }}" target="_blank" class="text-gray-500 hover:text-gray-700 text-xs">View</a>
                            <form action="{{ route('admin.schemes.destroy', $scheme) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this scheme?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-medium">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
  <td colspan="6" class="px-5 py-16 text-center">
    <div class="flex flex-col items-center gap-3">
      <div class="w-14 h-14 bg-slate-100 rounded-full flex items-center justify-center">
        <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
      </div>
      <p class="text-slate-500 font-medium">No schemes found</p>
      <p class="text-slate-400 text-sm">Try adjusting your filters or add a new scheme.</p>
      <a href="{{ route('admin.schemes.create') }}" class="mt-2 inline-flex items-center gap-1.5 bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add Scheme
      </a>
    </div>
  </td>
</tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $schemes->links() }}
</div>
@endsection
