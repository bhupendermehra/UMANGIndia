@extends('admin.layouts.app')

@section('title', 'Notifications')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Notifications</h1>
            <p class="text-slate-500 mt-1">Manage site-wide announcements and alerts</p>
        </div>
        <a href="{{ route('admin.notifications.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            New Notification
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
    @endif

    <div class="surface-card">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="border-b border-slate-200">
                    <tr>
                        <th class="text-left px-4 py-3 text-sm font-medium text-slate-600">Title</th>
                        <th class="text-left px-4 py-3 text-sm font-medium text-slate-600">Type</th>
                        <th class="text-center px-4 py-3 text-sm font-medium text-slate-600">Active</th>
                        <th class="text-center px-4 py-3 text-sm font-medium text-slate-600">Ack Req</th>
                        <th class="text-left px-4 py-3 text-sm font-medium text-slate-600">Schedule</th>
                        <th class="text-right px-4 py-3 text-sm font-medium text-slate-600">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($notifications as $notification)
                    <tr class="border-b border-slate-200 hover:bg-slate-50">
                        <td class="px-4 py-3">
                            <div class="font-medium text-slate-800">{{ $notification->title }}</div>
                            <div class="text-sm text-slate-500 mt-1 line-clamp-2">{{ Str::limit($notification->message, 80) }}</div>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                @if($notification->type === 'urgent') bg-red-100 text-red-700
                                @elseif($notification->type === 'warning') bg-amber-100 text-amber-700
                                @elseif($notification->type === 'success') bg-green-100 text-green-700
                                @else bg-blue-100 text-blue-700 @endif">
                                {{ ucfirst($notification->type) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($notification->is_active)
                                <span class="text-green-600 font-medium">Yes</span>
                            @else
                                <span class="text-slate-400">No</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($notification->requires_acknowledge)
                                <span class="text-amber-600 font-medium">Yes</span>
                            @else
                                <span class="text-slate-400">No</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-slate-600">
                            @if($notification->starts_at && $notification->ends_at)
                                {{ $notification->starts_at->format('d M Y') }} - {{ $notification->ends_at->format('d M Y') }}
                            @elseif($notification->starts_at)
                                From {{ $notification->starts_at->format('d M Y') }}
                            @elseif($notification->ends_at)
                                Until {{ $notification->ends_at->format('d M Y') }}
                            @else
                                Always
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('admin.notifications.edit', $notification) }}" class="text-blue-600 hover:underline text-sm font-medium">Edit</a>
                            <form action="{{ route('admin.notifications.destroy', $notification) }}" method="POST" class="inline" onsubmit="return confirm('Delete this notification?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-sm font-medium ml-3">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-slate-500">No notifications found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-4 py-3">
            {{ $notifications->links() }}
        </div>
    </div>
</div>
@endsection