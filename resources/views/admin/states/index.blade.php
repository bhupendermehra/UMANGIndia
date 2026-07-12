@extends('admin.layouts.app')

@section('title', 'Manage States')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">States / UTs</h1>
        <p class="text-gray-500 text-sm">{{ $states->count() }} total states/UTs</p>
    </div>
    <a href="{{ route('admin.states.create') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2.5 rounded-lg text-sm font-medium flex items-center gap-2 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add State
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-5 py-3 text-left font-semibold text-gray-600">Name</th>
                    <th class="px-5 py-3 text-left font-semibold text-gray-600">Name (Hindi)</th>
                    <th class="px-5 py-3 text-left font-semibold text-gray-600">Slug</th>
                    <th class="px-5 py-3 text-left font-semibold text-gray-600">Type</th>
                    <th class="px-5 py-3 text-left font-semibold text-gray-600">Schemes</th>
                    <th class="px-5 py-3 text-right font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($states as $state)
                <tr class="hover:bg-gray-50">
                    <td class="px-5 py-3 font-medium text-gray-800">{{ $state->name }}</td>
                    <td class="px-5 py-3 text-gray-500">{{ $state->name_hi ?? '—' }}</td>
                    <td class="px-5 py-3 text-gray-400 text-xs">{{ $state->slug }}</td>
                    <td class="px-5 py-3">
                        @if($state->is_central)
                            <span class="px-2 py-0.5 text-xs rounded-full bg-primary-100 text-primary-700">Central</span>
                        @else
                            <span class="px-2 py-0.5 text-xs rounded-full bg-gray-100 text-gray-600">State/UT</span>
                        @endif
                    </td>
                    <td class="px-5 py-3 text-gray-500">{{ $state->schemes_count }}</td>
                    <td class="px-5 py-3 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.states.edit', $state) }}" class="text-primary-600 hover:text-primary-700 text-xs font-medium">Edit</a>
                            <form action="{{ route('admin.states.destroy', $state) }}" method="POST" onsubmit="return confirm('Delete this state?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-medium">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-5 py-12 text-center text-gray-400">No states found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
