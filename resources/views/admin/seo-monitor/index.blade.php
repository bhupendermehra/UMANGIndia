@extends('admin.layouts.app')
@section('title', 'SEO Monitor')
@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold">SEO Monitor</h1>
    <form action="{{ route('admin.seo-monitor.run-check') }}" method="POST">
        @csrf
        <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 text-sm">Run SEO Check</button>
    </form>
</div>
<div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
        <div class="text-2xl font-bold text-gray-700">{{ $summary['total'] }}</div>
        <div class="text-sm text-gray-500">Total Checks</div>
    </div>
    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
        <div class="text-2xl font-bold text-green-600">{{ $summary['passed'] }}</div>
        <div class="text-sm text-gray-500">Passed</div>
    </div>
    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
        <div class="text-2xl font-bold text-red-600">{{ $summary['failed'] }}</div>
        <div class="text-sm text-gray-500">Failed</div>
    </div>
    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
        <div class="text-2xl font-bold text-yellow-600">{{ $summary['warnings'] }}</div>
        <div class="text-sm text-gray-500">Warnings</div>
    </div>
    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
        <div class="text-sm font-medium text-gray-600">By Type</div>
        @foreach($summary['by_type'] as $type => $count)
        <div class="text-xs text-gray-500">{{ $type }}: {{ $count }}</div>
        @endforeach
    </div>
</div>
<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    <div class="p-4 border-b border-gray-200">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.seo-monitor.index') }}" class="px-3 py-1.5 text-sm rounded {{ !request('status') ? 'bg-primary-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">All</a>
            <a href="{{ route('admin.seo-monitor.index', ['status' => 'fail']) }}" class="px-3 py-1.5 text-sm rounded {{ request('status') == 'fail' ? 'bg-primary-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">Failed</a>
            <a href="{{ route('admin.seo-monitor.index', ['status' => 'warning']) }}" class="px-3 py-1.5 text-sm rounded {{ request('status') == 'warning' ? 'bg-primary-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">Warnings</a>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left px-4 py-3 font-medium text-gray-600">Page URL</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-600">Check</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-600">Status</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-600">Issue</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-600">Checked</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($checks as $check)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 max-w-xs truncate text-gray-700">{{ $check->page_url }}</td>
                    <td class="px-4 py-3">{{ $check->check_type }}</td>
                    <td class="px-4 py-3">
                        @if($check->status == 'pass') <span class="text-green-600">Pass</span>
                        @elseif($check->status == 'fail') <span class="text-red-600">Fail</span>
                        @else <span class="text-yellow-600">Warning</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-gray-500 text-xs max-w-xs truncate">{{ Str::limit($check->issue_detail, 80) ?? '—' }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $check->checked_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">No SEO checks yet. Run a check to see results.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-4 py-3 border-t border-gray-100">{{ $checks->links() }}</div>
</div>
@endsection