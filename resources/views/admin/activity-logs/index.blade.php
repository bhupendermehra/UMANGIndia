@extends('admin.layouts.app')
@section('title', 'Activity Logs')
@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold">Activity Logs</h1>
    <form action="{{ route('admin.activity-logs.clear') }}" method="POST">
        @csrf
        <button type="submit" class="text-sm text-red-600 hover:underline" onclick="return confirm('Delete logs older than 30 days?')">Clear Old Logs</button>
    </form>
</div>
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    @foreach($actions as $action => $count)
    <div class="bg-white p-3 rounded-lg shadow-sm border border-gray-200">
        <div class="text-lg font-bold text-gray-700">{{ $count }}</div>
        <div class="text-xs text-gray-500">{{ str_replace('_', ' ', $action) }}</div>
    </div>
    @endforeach
</div>
<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left px-4 py-3 font-medium text-gray-600">Time</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-600">User</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-600">Action</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-600">Model</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-600">Description</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($logs as $log)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-gray-500 whitespace-nowrap">{{ $log->created_at->format('d M H:i') }}</td>
                    <td class="px-4 py-3">{{ $log->user->name ?? 'System' }}</td>
                    <td class="px-4 py-3">
                        <span class="text-xs px-2 py-1 rounded 
                            @if($log->action == 'create') bg-green-100 text-green-700
                            @elseif($log->action == 'update') bg-blue-100 text-blue-700
                            @elseif($log->action == 'delete') bg-red-100 text-red-700
                            @else bg-gray-100 text-gray-700 @endif">
                            {{ $log->action }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-gray-600">{{ $log->model_type }}</td>
                    <td class="px-4 py-3 text-gray-500 max-w-xs truncate">{{ Str::limit($log->description, 80) }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">No activity logged yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-4 py-3 border-t border-gray-100">{{ $logs->links() }}</div>
</div>
@endsection