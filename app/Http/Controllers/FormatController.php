<?php

namespace App\Http\Controllers;

use App\Beneficiary;
use App\Employee;
use App\Format;
use App\Http\Requests\FormatRequest;
use Barryvdh\DomPDF\PDF;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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
        $stream = $pdf->loadHTML(
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
        return $stream->stream($beneficiary->full_name . '.pdf');
    }

    public function format_authorization($beneficiary_id, PDF $pdf)
    {
        $beneficiary = Beneficiary::find($beneficiary_id);
        $employee = Employee::find(Auth::user()->id);
        $date = new DateTime();
        $month = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        $stream = $pdf->loadHTML(
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
                        .pa{font-size: 14px;} .cod{ text-align: center; font-size: 10px; } .co{ text-align: center; font-size: 12px; } .cc{margin-left: 90px;} p{text-align: justify;} img{padding-left: 25px;}}
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
                                    <p class="cod">CÓDIGO: PVDLAB-FOR06</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="cod">VERSIÓN: 2</p>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <p class="co">FORMATO DE ACUERDO DE RESPONSABILIDAD EN PRÉSTAMO DE EQUIPOS </p>
                                </td>
                                <td>
                                    <p class="cod">FECHA: ' . strtoupper($month[$date->format('m') - 1]) . ' ' . strtoupper($date->format('Y')) . '</p>
                                </td>
                            </tr>
                            </tbody>
                        </table> <br />
                        <p class="pa"><strong>Yo,</strong> ' . $beneficiary->full_name . ', mayor de edad, domiciliado en
                        ' . $beneficiary->address . ', identificado con ' . $beneficiary->document_type . ' N&ordm;.
                      ' . $beneficiary->document . ', en mi calidad de persona natural cuya imagen ser&aacute; fijada en la
                        producci&oacute;n audiovisual ___________________________________________ , que utilizar&aacute; y publicar&aacute;
                        <strong>EL PUNTO VIVE DIGITAL LAB Valledupar</strong> en el marco de la promoci&oacute;n de la misma, suscribo el
                        presente documento en donde autorizo y consiento expresamente el uso de derechos de imagen sobre fotograf&iacute;a y
                        procedimientos an&aacute;logos y/o digitales a la fotograf&iacute;a, o producci&oacute;n audiovisual. &nbsp;Esta
                        autorizaci&oacute;n se regir&aacute; por las normas legales aplicables y en particular por las siguientes cl&aacute;usulas:
                        <strong>PRIMERA - AUTORIZACI&Oacute;N:</strong> mediante el presente documento autorizo de forma irrevocable y
                        gratuita, la utilizaci&oacute;n de los derechos de imagen sobre fotograf&iacute;as o procedimientos an&aacute;logos
                        y/o digitales a la fotograf&iacute;a, o producciones audiovisuales (videos) a <strong>EL PUNTO VIVE DIGITAL LAB
                            Valledupar</strong> &nbsp;para incluirlos en su galeria y usarlas en activiades de promoci&oacute;n del proyecto
                        audiovisual.&nbsp; <strong>SEGUNDA - OBJETO: </strong>Autorizar el uso de derechos de imagen sobre fotografias y
                        fijaciones audiovisuales en el marco del proyecto Audiovisual: <strong>Programa de televisi&oacute;n &ldquo;Pol&iacute;tica
                            P&uacute;blica y Algo M&aacute;s&rdquo; PAR&Aacute;GRAFO I - ALCANCE DEL OBJETO:</strong> la presente autorizaci&oacute;n
                        de uso se otorga a <strong>EL PUNTO VIVE DIGITAL LAB Valledupar</strong>, para ser utilizada en (ediciones
                        audiovisuales impresas y digitales, tv y en Internet (como redes sociales, sitio web, entre otros similares siempre
                        que no representen un riesgo para la integridad de las partes.).&nbsp; <strong>PAR&Aacute;GRAFO II:</strong> tal uso
                        se realizar&aacute; por parte de EL PUNTO VIVE DIGITAL LAB Valledupar, para efectos de su publicaci&oacute;n de
                        manera directa, o a trav&eacute;s de un tercero que se designe para tal fin. &nbsp;<strong>TERCERA -
                            TERRITORIO: </strong>los derechos aqu&iacute; autorizados se dan sin limitaci&oacute;n geogr&aacute;fica o
                        territorial alguna. <strong>CUARTA - ALCANCE:</strong> la presente autorizaci&oacute;n se da para formato o soporte
                        material, y se extiende a la utilizaci&oacute;n en medio &oacute;ptico, magn&eacute;tico, electr&oacute;nico, en
                        red, mensajes de datos o similar conocido o por conocer en el futuro. <strong>QUINTA - EXCLUSIVIDAD:</strong> la
                        autorizaci&oacute;n de uso aqu&iacute; establecida no implica exclusividad en favor de la <strong>PUNTO VIVE LAB
                            Valledupar</strong>. Por lo tanto, me reservo y conservar&eacute; el derecho de otorgar directamente, u otorgar
                        a cualquier tercero, autorizaciones de uso similares o en los mismos t&eacute;rminos aqu&iacute; acordados, siempre
                        y cuando mantenga el reconocimiento al <strong>EL PUNTO VIVE DIGITAL LAB Valledupar.</strong> &nbsp;<strong>SEXTA
                            &ndash; EXIMENTE DE RESPONSABILIDAD:</strong> <strong>EL PUNTO VIVE DIGITAL LAB Valledupar</strong>, se exime de
                        responsabilidad sobre cualquier uso que pueda hacer un tercero de las Im&aacute;genes fuera del &aacute;mbito
                        territorial, temporal y material objeto del presente acuerdo. <strong>SEPTIMA- DERECHOS MORALES </strong>(Cr&eacute;ditos
                        y menci&oacute;n): la autorizaci&oacute;n de los derechos antes mencionados no implica la cesi&oacute;n de los
                        derechos morales sobre los mismos por cuanto de conformidad con lo establecido en el art&iacute;culo 6 Bis del
                        Convenio de Berna para la protecci&oacute;n de las obras literarias, art&iacute;sticas y cient&iacute;ficas; art&iacute;culo
                        30 de la Ley 23 de 1982 y art&iacute;culo 11 de la Decisi&oacute;n Andina 351 de 1993, Ley 1581 de 2012 (Ley de
                        Protecci&oacute;n de Datos Personales). Estos derechos son irrenunciables, imprescriptibles, inembargables e
                        inalienables. Por lo tanto, los mencionados derechos seguir&aacute;n bajo mi titularidad. <strong>OCTAVA- PROTECC&Oacute;N
                            DE USO DE DATOS:</strong> Dando Cumplimiento a lo dispuesto en la Ley estatutaria 1581&nbsp;&nbsp; de 2012&nbsp;&nbsp;
                        y a su Decreto Reglamentario 1377 de 2013, <strong>EL PUNTO VIVE DIGITAL LAB Valledupar</strong> adopta la presente
                        pol&iacute;tica para el tratamiento de datos personales, la cual ser&aacute; informada a todos los titulares de los
                        datos recolectados o que en el futuro se&nbsp;&nbsp; obtengan en el ejercicio de las actividades contractuales,
                        comerciales o laborales. De esta manera, <strong>EL PUNTO VIVE DIGITAL LAB Valledupar</strong> manifiesta que
                        garantiza los derechos de la privacidad, la intimidad, el&nbsp; buen nombre y la autonom&iacute;a, en&nbsp; el&nbsp;&nbsp;
                        tratamiento&nbsp; de&nbsp; los&nbsp; datos&nbsp; personales,&nbsp; y&nbsp;&nbsp; en&nbsp; consecuencia&nbsp; todas&nbsp;
                        sus actuaciones se regir&aacute;n por los principios de legalidad, finalidad, libertad, veracidad o calidad,
                        transparencia, acceso y circulaci&oacute;n restringida, seguridad y confidencialidad.</p>
                        <p class="pa">&nbsp;</p>
                        <p class="pa">Firma:&nbsp; __________________________________________________</p>
                        <p class="pa">Nombre:&nbsp; _________________________________________________</p>
                        <p class="pa">&nbsp;C&eacute;dula No. ______________________________ de _____________________________</p>
                    </html>');
        return $stream->stream($beneficiary->full_name . '.pdf');
    }
}
