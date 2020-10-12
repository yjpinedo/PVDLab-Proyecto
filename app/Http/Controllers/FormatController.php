<?php

namespace App\Http\Controllers;

use App\Beneficiary;
use App\Employee;
use App\Format;
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
}
