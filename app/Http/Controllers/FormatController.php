<?php

namespace App\Http\Controllers;

use App\Beneficiary;
use App\Employee;
use App\Format;
use App\Loan;
use App\Project;
use Illuminate\Http\Request;
use PDF;
use DateTime;
use Illuminate\Support\Facades\Auth;

class FormatController extends BaseController
{
    /**
     * Create a controller instance.
     *
     * @param Format $entity
     */
    public function __construct(Format $entity)
    {
        parent::__construct($entity);
    }

    public function format_responsibility($beneficiary_id)
    {
        $beneficiary = Beneficiary::find($beneficiary_id);
        $employee = Employee::find(Auth::user()->id);
        $date = new DateTime();
        $month = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        $month = strtoupper($month[$date->format('m') - 1]) . ' ' . strtoupper($date->format('Y'));
        return PDF::loadView('formats.responsibility', ['beneficiary' => $beneficiary, 'employee' => $employee, 'month' => $month])->stream();
    }

    public function format_authorization($beneficiary_id)
    {
        $beneficiary = Beneficiary::find($beneficiary_id);
        $date = new DateTime();
        $month = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        $month = strtoupper($month[$date->format('m') - 1]) . ' ' . strtoupper($date->format('Y'));
        return PDF::loadView('formats.authorization', ['beneficiary' => $beneficiary, 'month' => $month])->stream();
    }

    public function format_loans($beneficiary_id, $loan_id)
    {
        $beneficiary = Beneficiary::find($beneficiary_id);
        $loan = Loan::whereId($loan_id)->with('articles')->first();
        $date = new DateTime();
        $month = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        $month = strtoupper($month[$date->format('m') - 1]) . ' ' . strtoupper($date->format('Y'));

        return PDF::loadView('formats.loans', ['beneficiary' => $beneficiary, 'month' => $month, 'loan' => $loan])->stream();
    }

    public function format_project($project_id)
    {
        $project = Project::whereId($project_id)->with(['beneficiary', 'employee.position', 'members'])->first();
        $date = new DateTime();
        $month = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        $month = strtoupper($month[$date->format('m') - 1]) . ' ' . strtoupper($date->format('Y'));

        return PDF::loadView('formats.projects', ['project' => $project, 'month' => $month])->stream();
    }

    public function getLoansByBeneficiary(Request $request)
    {
        $request->validate([
            'beneficiary_id' => 'required|exists:beneficiaries,id'
        ]);

        $beneficiary = Beneficiary::whereId($request->only('beneficiary_id'))->first();
        $loans = $beneficiary->loans;
        if (count($loans) > 0) {
            $response = [
                'data' => $loans,
                'error' => false
            ];
        } else {
            $response = [
                'message' => __('app.messages.loan.validate_loans', ['name' => $beneficiary->full_name]),
                'error' => true
            ];
        }
        return response()->json($response);
    }
}
