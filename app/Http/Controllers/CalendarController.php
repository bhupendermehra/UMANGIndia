<?php

namespace App\Http\Controllers;

use App\Models\Scheme;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $month = (int) $request->input('month', now()->month);
        $year = (int) $request->input('year', now()->year);

        // Validate bounds
        $month = max(1, min(12, $month));
        $year = max(2000, min(2099, $year));

        $currentDate = Carbon::createFromDate($year, $month, 1);

        // Schemes with deadlines in this month, grouped by date
        $schemesInMonth = Scheme::with('category')
            ->whereNotNull('application_deadline')
            ->whereYear('application_deadline', $year)
            ->whereMonth('application_deadline', $month)
            ->orderBy('application_deadline')
            ->get()
            ->groupBy(function ($scheme) {
                return $scheme->application_deadline->format('Y-m-d');
            });

        // Upcoming 10 deadlines from today onwards (for sidebar)
        $upcomingDeadlines = Scheme::with('category')
            ->whereNotNull('application_deadline')
            ->where('application_deadline', '>=', now()->subDay())
            ->orderBy('application_deadline')
            ->take(10)
            ->get();

        // Build calendar grid (weeks starting Monday)
        $firstDay = $currentDate->copy()->startOfMonth();
        $lastDay = $currentDate->copy()->endOfMonth();
        $startOfCalendar = $firstDay->copy()->startOfWeek(Carbon::MONDAY);
        $endOfCalendar = $lastDay->copy()->endOfWeek(Carbon::SUNDAY);

        $weeks = [];
        $date = $startOfCalendar->copy();
        while ($date <= $endOfCalendar) {
            $week = [];
            for ($i = 0; $i < 7; $i++) {
                $week[] = $date->copy();
                $date->addDay();
            }
            $weeks[] = $week;
        }

        $prevMonth = $currentDate->copy()->subMonth();
        $nextMonth = $currentDate->copy()->addMonth();

        // Category colour palette — consistent per category ID
        $categoryColors = [
            '#3B82F6', // blue-500
            '#10B981', // emerald-500
            '#F59E0B', // amber-500
            '#EF4444', // red-500
            '#8B5CF6', // violet-500
            '#EC4899', // pink-500
            '#14B8A6', // teal-500
            '#F97316', // orange-500
            '#6366F1', // indigo-500
            '#84CC16', // lime-500
        ];

        return view('calendar.index', compact(
            'month', 'year', 'currentDate',
            'schemesInMonth', 'upcomingDeadlines',
            'weeks', 'prevMonth', 'nextMonth',
            'categoryColors'
        ));
    }
}
