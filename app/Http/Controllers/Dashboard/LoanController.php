<?php

namespace App\Http\Controllers\Dashboard;

use App\Loan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    public function index()
    {
        $formatStateLoanForMonth = [];
        $formatLoanForMonth = [];
        $monthFormat = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
        $loansLimit = Loan::limit(10)
            ->orderBy('created_at', 'DESC')
            ->with('employee', 'beneficiary')
            ->get();

        $loanForMonth = Loan::whereYear('created_at', date('Y'))
            ->select(DB::raw('COUNT(*) as count'))
            ->groupBy(DB::raw('Month(created_at)'))
            ->pluck('count');

        $monthsForLoan = Loan::whereYear('created_at', date('Y'))
            ->select(DB::raw('Month(created_at) as month'))
            ->groupBy(DB::raw('Month(created_at)'))
            ->pluck('month');

        $stateLoanForMonth = Loan::whereYear('created_at', date('Y'))
            ->select(DB::raw('Month(created_at) as month, state, COUNT(*) as count'))
            ->groupBy(DB::raw('state, Month(created_at)'))->get();

        foreach ($monthsForLoan as $index => $month) {
            $month = (string) $month;
            if (strlen($month) == 1) {
                $formatLoanForMonth[date('Y') . '-0' . $month] = $loanForMonth[$index];
            } else {
                $formatLoanForMonth[date('Y') . '-' . $month] = $loanForMonth[$index];
            }
        }

        foreach ($stateLoanForMonth as $loan) {
            if ($loan->state == 'APROBADO'){
                array_push($formatStateLoanForMonth, [
                    'approved' => [
                        $monthFormat[$loan->month-1] => $loan->count,
                    ]
                ]);
            } else if ($loan->state == 'RECHAZADO') {
                array_push($formatStateLoanForMonth, [
                    'rejected' => [
                        $monthFormat[$loan->month-1] => $loan->count,
                    ]
                ]);
            } else {
                array_push($formatStateLoanForMonth, [
                    'pending' => [
                        $monthFormat[$loan->month-1] => $loan->count,
                    ]
                ]);
            }
        }

        $totalLoan = Loan::count();
        $stateApprovedCount = Loan::whereState('APROBADO')->count();
        $stateRejectedCount = Loan::whereState('RECHAZADO')->count();
        $statePendingCount = Loan::whereState('PENDIENTE')->count();

        $percents = [
            'approved' => round((($stateApprovedCount * 100) / $totalLoan)),
            'rejected' => round((($stateRejectedCount * 100) / $totalLoan)),
            'pending' => round((($statePendingCount * 100) / $totalLoan)),
        ];

        return view('dashboard.loans', [
            'stateApprovedCount' => $stateApprovedCount,
            'stateRejectedCount' => $stateRejectedCount,
            'statePendingCount' => $statePendingCount,
            'formatLoanForMonth' => $formatLoanForMonth,
            'formatStateLoanForMonth' => $formatStateLoanForMonth,
            'loansLimit' => $loansLimit,
            'percents' => $percents,
            'totalLoan' => $totalLoan,
        ]);
    }
}
