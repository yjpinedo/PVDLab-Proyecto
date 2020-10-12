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

    public function format_responsibility($beneficiary_id, PDF $pdf)
    {
        $beneficiary = Beneficiary::find($beneficiary_id);
        $employee = Employee::find(Auth::user()->id);
        $date = new DateTime();
        $month = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        $month = strtoupper($month[$date->format('m') - 1]) . ' ' . strtoupper($date->format('Y'));
        /*$stream = PDF::loadHTML(
            '<!DOCTYPE html>
                    <html>
                    <head>
                        <title></title>
                        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
                        <meta name="author" content="ADMINISTRACION" />
                        <meta name="lastsavedby" content="ADMINISTRACION" />
                        <meta name="datecontentcreated" content="2017-12-28T15:59:00Z" />
                        <meta name="datelastsaved" content="2017-12-28T16:06:00Z" />
                        <meta name="application" content="Microsoft Office Word" />
                    </head>
                    <style>
                        .cod{ text-align: center; font-size: 10px; } .co{ text-align: center; font-size: 12px; } .cc{margin-left: 90px;} p{text-align: justify;} img{padding-left: 22px;}}
                    </style>

                    <body>
                    <table border="1" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                            <td rowspan="3">
                                <img src="img/1.jpg" width="150" height="70" >
                            </td>
                            <td rowspan="2">
                                <p class="co">PUNTO VIVE DIGITAL LAB VALLEDUPAR</p>
                            </td>
                            <td>
                                <p class="cod">CÓDIGO: PVDLAB-FOR05</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="cod">VERSIÓN: 3</p>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <p class="co">FORMATO DE PROPIEDAD INTELECTUAL Y AUTORIZACIÓN DE USO DE DERECHOS DE IMAGEN SOBRE FOTOGRAFÍAS Y FIJACIONES AUDIOVISUALES (VIDEOS)</p>
                            </td>
                            <td>
                                <p class="cod">FECHA: ' . strtoupper($month[$date->format('m') - 1]) . ' ' . strtoupper($date->format('Y')) . '</p>
                            </td>
                        </tr>
                        </tbody>
                    </table> <br />
                    <p>Entre los suscritos a saber: Por una parte ' . $beneficiary->full_name . ', mayor de edad, identificado(a) con ' . $beneficiary->document_type . ' No. ' . $beneficiary->document . '
                        expedida en ' . $beneficiary->expedition_place . ', Quien se denomina <b>EL</b> <b>BENEFICIARIO</b>, quien recibe en calidad de préstamo, y por otra parte ' . $employee->full_name . ',
                        en representación del Punto Vive Digital Lab Valledupar, también mayor de edad, identificado(a) con ' . $employee->document_type . ' No. ' . $employee->document . ', expedida
                        en ' . $employee->expedition_place . ', quien se denomina <b>PVDLAB VALLEDUPAR</b>, se realiza el préstamo de equipos para uso dentro y/o fuera de las
                        instalaciones del punto. Dicho préstamo se rige por las siguientes clausulas: </p>
                    <p><b>PRIMERO: OBJETO</b>; El Objeto del presente préstamo es con el fin de que <b>EL BENEFICIARIO</b> (quien recibe en calidad de préstamo los equipos
                        y accesorios que se describen en la cláusula Cuarta), desarrolle los proyectos audiovisuales denominados: Largometraje “La Frontera” y el Cortometraje
                        “ Paco: La Fábula” con el apoyo del <b>PVDLAB VALLEDUPAR</b>. </p>
                    <p><b>SEGUNDO: BUEN USO</b>; <b>EL BENEFICIARIO, </b>se responsabiliza a darle uso pertinente a los equipos que recibe en calidad de préstamo y se hace
                        responsable por cualquier pérdida o daño que afecte el buen uso de los mismos. </p>
                    <p><b>TERCERO: AUDITORIA E INSPECCIÓN</b>; <b>EL PVDLAB VALLEDUPAR</b>, se reserva el derecho para hacer Auditoría e Inspección a los equipos que preste
                        y que le pertenecen, pudiendo quitar los equipos de su propiedad por riesgo de daño, o mal uso que se le den a sus equipos, so pena de iniciar acciones
                        legales si por culpa o descuido se haga mal uso, o se cause daño a los equipos por parte de <b>EL BENEFICIARIO</b> </p>
                    <p><b>CUARTO</b>: <b>DESCRIPCIÓN DEL (LOS) EQUIPO (S)</b>: </p>
                    <p><b>QUINTO: RESPONSABILIDAD SOLIDARIA</b>; <b>EL BENEFICIARIO</b>, se hace responsable solidariamente por los daños que cause al(los) equipo(s) que recibe
                        en calidad de préstamo del <b>PVDLAB VALLEDUPAR </b>y que por su culpa u omisión de cuidado sufra el equipo de propiedad de <b>EL BENEFICIARIO</b>,
                        el cual prestará merito ejecutivo, con base al Art. 422 del Nuevo Código General del Proceso.</p>
                    <p>Dado en Valledupar, a los ' . $date->format('d') . ' días del mes de ' . $month[$date->format('m') - 1] . '.</p> <br>
                    <p class="cc"><b>&nbsp;&nbsp;EL BENEFICIARIO</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;por
                        el <b>PVDLAB VALLEDUPAR </b></p>
                    <p class="cc">_____________________________ &nbsp;&nbsp;&nbsp;_________________________________</p>
                    <p class="cc">C.C. No. ______________________ C.C. No. __________________________</p><br>
                    <p style="text-align: center">Nota: El Documento debe llevar Huella de quien recibe y debe dejar fotocopia de Cédula al 200%.</p> <br /></body>

                    </html>');
        */
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
