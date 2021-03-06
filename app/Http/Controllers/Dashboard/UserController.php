<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index ()
    {
        $formatUserForMonth = [];
        $formatTypeUserForMonth = [];
        $monthFormat = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];

        $usersForMonth = User::whereYear('created_at', date('Y'))
            ->select(DB::raw('COUNT(*) as count'))
            ->groupBy(DB::raw('Month(created_at)'))
            ->pluck('count');

        $typeUsersForMonth = User::whereYear('created_at', date('Y'))
            ->select(DB::raw('Month(created_at) as month, model_type as model, COUNT(*) as count'))
            ->groupBy(DB::raw('model_type, Month(created_at)'))->get();

        $months = User::whereYear('created_at', date('Y'))
            ->select(DB::raw('Month(created_at) as month'))
            ->groupBy(DB::raw('Month(created_at)'))
            ->pluck('month');

        foreach ($months as $index => $month) {
            $month = (string) $month;
            if (strlen($month) == 1) {
                $formatUserForMonth[date('Y') . '-0' . $month] = $usersForMonth[$index];
            } else {
                $formatUserForMonth[date('Y') . '-' . $month] = $usersForMonth[$index];
            }
        }

        foreach ($typeUsersForMonth as $user) {
            if ($user->model == 'App\Beneficiary'){
                array_push($formatTypeUserForMonth, [
                    'beneficiary' => [
                        $monthFormat[$user->month-1] => $user->count,
                    ]
                ]);
            } else if ($user->model == 'App\Employee') {
                array_push($formatTypeUserForMonth, [
                    'employee' => [
                        $monthFormat[$user->month-1] => $user->count,
                    ]
                ]);
            } else {
                array_push($formatTypeUserForMonth, [
                    'teacher' => [
                        $monthFormat[$user->month-1] => $user->count,
                    ]
                ]);
            }
        }

        $totalUser = User::count();
        $totalBeneficiary = User::where('model_type', 'App\Beneficiary')->count();
        $totalTeacher = User::where('model_type', 'App\Teacher')->count();
        $totalEmployee = User::where('model_type', 'App\Employee')->count();

        $percents = [
            'beneficiary' => round((($totalBeneficiary * 100) / $totalUser)),
            'employee' => round((($totalEmployee * 100) / $totalUser)),
            'teacher' => round((($totalTeacher * 100) / $totalUser)),
        ];

        $userLimit = User::limit(10)->orderBy('created_at', 'DESC')->get();

        return view('dashboard.users', [
            'totalUser' => $totalUser,
            'totalBeneficiary' => $totalBeneficiary,
            'totalTeacher' => $totalTeacher,
            'totalEmployee' => $totalEmployee,
            'percents' => $percents,
            'formatUserForMonth' => $formatUserForMonth,
            'formatTypeUserForMonth' => $formatTypeUserForMonth,
            'userLimit' => $userLimit,
        ]);
    }
}
