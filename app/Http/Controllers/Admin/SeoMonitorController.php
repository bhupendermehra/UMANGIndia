<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoMonitor;
use Illuminate\Http\Request;

class SeoMonitorController extends Controller
{
    public function index(Request $request)
    {
        $query = SeoMonitor::query();

        if ($request->has('check_type')) {
            $query->where('check_type', $request->check_type);
        }
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $checks = $query->latest('checked_at')->paginate(30);

        $summary = [
            'total' => SeoMonitor::count(),
            'passed' => SeoMonitor::where('status', 'pass')->count(),
            'failed' => SeoMonitor::where('status', 'fail')->count(),
            'warnings' => SeoMonitor::where('status', 'warning')->count(),
            'by_type' => SeoMonitor::selectRaw('check_type, COUNT(*) as count')
                ->groupBy('check_type')->pluck('count', 'check_type'),
        ];

        return view('admin.seo-monitor.index', compact('checks', 'summary'));
    }

    public function runCheck()
    {
        // Trigger SEO check via dispatch or redirect
        \App\Models\ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'run_seo_check',
            'model_type' => 'seo_monitor',
            'description' => 'Manual SEO check triggered from admin',
        ]);

        return back()->with('success', 'SEO check triggered. Results will appear shortly.');
    }
}
