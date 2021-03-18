<?php

namespace App\Http\Controllers\Employee\Dashboard;

use App\Course;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index()
    {
        $formatCourseForMonth = [];
        $formatStateCourseForMonth = [];
        $monthFormat = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];

        $coursesLimit = Course::limit(10)->orderBy('created_at', 'DESC')->with('teacher')->get();
        $coursesForMonth = Course::whereYear('created_at', date('Y'))
            ->select(DB::raw('COUNT(*) as count'))
            ->groupBy(DB::raw('Month(created_at)'))
            ->pluck('count');

        $StateCourseForMonth = Course::whereYear('created_at', date('Y'))
            ->select(DB::raw('Month(created_at) as month, state, COUNT(*) as count'))
            ->groupBy(DB::raw('state, Month(created_at)'))->get();

        $months = Course::whereYear('created_at', date('Y'))
            ->select(DB::raw('Month(created_at) as month'))
            ->groupBy(DB::raw('Month(created_at)'))
            ->pluck('month');

        foreach ($months as $index => $month) {
            $month = (string) $month;
            if (strlen($month) == 1) {
                $formatCourseForMonth[date('Y') . '-0' . $month] = $coursesForMonth[$index];
            } else {
                $formatCourseForMonth[date('Y') . '-' . $month] = $coursesForMonth[$index];
            }
        }

        foreach ($StateCourseForMonth as $course) {
            if ($course->state == 'DISPONIBLE'){
                array_push($formatStateCourseForMonth, [
                    'available' => [
                        $monthFormat[$course->month-1] => $course->count,
                    ]
                ]);
            } else {
                array_push($formatStateCourseForMonth, [
                    'closed' => [
                        $monthFormat[$course->month-1] => $course->count,
                    ]
                ]);
            }
        }

        return view('employees.dashboard.courses', [
            'coursesLimit' => $coursesLimit,
            'formatCourseForMonth' => $formatCourseForMonth,
            'formatStateCourseForMonth' => $formatStateCourseForMonth,
        ]);
    }
}
