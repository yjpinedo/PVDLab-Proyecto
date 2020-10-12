<!DOCTYPE html>
<html>
<head>
    <title>Formato de Responsabilidad</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="ADMINISTRACION" />
    <meta name="lastsavedby" content="ADMINISTRACION" />
    <meta name="datecontentcreated" content="2017-12-28T15:59:00Z" />
    <meta name="datelastsaved" content="2017-12-28T16:06:00Z" />
    <meta name="application" content="Microsoft Office Word" />
</head>
<style>
    .pa{font-size: 14px;} .cod{ text-align: center; font-size: 13px; } .co{ text-align: center; font-size: 12px; } .cc{margin-left: 70px;} p{text-align: justify;} img{padding-left: 25px;}
</style>

<body>
<table border="1" cellspacing="0" cellpadding="0">
    <tbody>
    <tr>
        <td rowspan="3" width="173" height="100">
            <img src="img/1.jpg" width="193" height="130" >
        </td>
        <td rowspan="2">
            <p class="co"><strong>PUNTO VIVE DIGITAL LAB VALLEDUPAR</strong></p>
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
            <p class="co"><strong>FORMATO DE ACUERDO DE RESPONSABILIDAD EN PRÉSTAMO DE EQUIPOS</strong></p>
        </td>
        <td>
            <p class="cod">FECHA: {{ $month }} </p>
        </td>
    </tr>
    </tbody>
</table> <br />
<p>Entre los suscritos a saber: Por una parte {{ $beneficiary->full_name }} , mayor de edad, identificado(a) con
    {{ $beneficiary->document_type }} No. {{ $beneficiary->document }} expedida en {{ $beneficiary->expedition_place }},
    Quien se denomina <b>EL</b> <b>BENEFICIARIO</b>, quien recibe en calidad de préstamo, y por otra parte
    {{ $employee->full_name }}, en representación del Punto Vive Digital Lab Valledupar, también mayor de edad, identificado(a) con
    {{ $employee->document_type }} No. {{ $employee->document }} , expedida
    en {{ $employee->expedition_place}}, quien se denomina <b>PVDLAB VALLEDUPAR</b>, se realiza el préstamo de equipos para uso dentro y/o fuera de las
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
<p>Dado en Valledupar, a los {{ \Carbon\Carbon::now()->format('d') }} d&iacute;as del mes de {{ $month }}.</p>
<p class="cc"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EL BENEFICIARIO</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;por
    el <b>PVDLAB VALLEDUPAR </b></p>
<p class="cc">_______________________________ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_________________________________</p>
<p class="cc">C.C. ___________________________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C.C. _____________________________</p> <br>
<p style="text-align: center">Nota: El Documento debe llevar Huella de quien recibe y debe dejar fotocopia de Cédula al 200%.</p>
<br />
</body>
</html>
