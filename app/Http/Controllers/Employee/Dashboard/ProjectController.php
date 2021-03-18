<?php

namespace App\Http\Controllers\Employee\Dashboard;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function index()
    {
        $formatConceptProjectForMonth = [];
        $formatProjectForMonth = [];
        $monthFormat = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
        $projectsLimit = Project::limit(10)
            ->orderBy('created_at', 'DESC')
            ->with('employee', 'beneficiary')
            ->get();

        $projectForMonth = Project::whereYear('created_at', date('Y'))
            ->select(DB::raw('COUNT(*) as count'))
            ->groupBy(DB::raw('Month(created_at)'))
            ->pluck('count');

        $monthsForProject = Project::whereYear('created_at', date('Y'))
            ->select(DB::raw('Month(created_at) as month'))
            ->groupBy(DB::raw('Month(created_at)'))
            ->pluck('month');

        $conceptProjectForMonth = Project::whereYear('created_at', date('Y'))
            ->select(DB::raw('Month(created_at) as month, concept as concept, COUNT(*) as count'))
            ->groupBy(DB::raw('concept, Month(created_at)'))->get();

        foreach ($monthsForProject as $index => $month) {
            $month = (string) $month;
            if (strlen($month) == 1) {
                $formatProjectForMonth[date('Y') . '-0' . $month] = $projectForMonth[$index];
            } else {
                $formatProjectForMonth[date('Y') . '-' . $month] = $projectForMonth[$index];
            }
        }

        foreach ($conceptProjectForMonth as $project) {
            if ($project->concept == 'APROBADO'){
                array_push($formatConceptProjectForMonth, [
                    'approved' => [
                        $monthFormat[$project->month-1] => $project->count,
                    ]
                ]);
            } else if ($project->concept == 'RECHAZADO') {
                array_push($formatConceptProjectForMonth, [
                    'rejected' => [
                        $monthFormat[$project->month-1] => $project->count,
                    ]
                ]);
            } else {
                array_push($formatConceptProjectForMonth, [
                    'pending' => [
                        $monthFormat[$project->month-1] => $project->count,
                    ]
                ]);
            }
        }

        $totalProject = Project::count();
        $conceptApprovedCount = Project::whereConcept('APROBADO')->count();
        $conceptRejectedCount = Project::whereConcept('RECHAZADO')->count();
        $conceptPendingCount = Project::whereConcept('PENDIENTE')->count();

        $percents = [
            'approved' => round((($conceptApprovedCount * 100) / $totalProject)),
            'rejected' => round((($conceptRejectedCount * 100) / $totalProject)),
            'pending' => round((($conceptPendingCount * 100) / $totalProject)),
        ];

        return view('employees.dashboard.projects', [
            'conceptApprovedCount' => $conceptApprovedCount,
            'conceptRejectedCount' => $conceptRejectedCount,
            'conceptPendingCount' => $conceptPendingCount,
            'formatProjectForMonth' => $formatProjectForMonth,
            'formatConceptProjectForMonth' => $formatConceptProjectForMonth,
            'projectsLimit' => $projectsLimit,
            'percents' => $percents,
            'totalProject' => $totalProject,
        ]);
    }
}
