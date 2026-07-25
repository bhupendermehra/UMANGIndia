<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::with('user');

        if ($request->has('action')) {
            $query->where('action', $request->action);
        }
        if ($request->has('model_type')) {
            $query->where('model_type', $request->model_type);
        }

        $logs = $query->latest()->paginate(30);
        $actions = ActivityLog::selectRaw('action, COUNT(*) as count')
            ->groupBy('action')->orderByDesc('count')->pluck('count', 'action');

        return view('admin.activity-logs.index', compact('logs', 'actions'));
    }

    public function clear()
    {
        ActivityLog::where('created_at', '<', now()->subDays(30))->delete();
        return back()->with('success', 'Logs older than 30 days cleared.');
    }
}
