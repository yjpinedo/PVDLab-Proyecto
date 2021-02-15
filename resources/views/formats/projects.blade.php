<!DOCTYPE html>
<html>
<head>
    <title>Formato de salida de equipos</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<style>
    .pa{font-size: 14px;} .cod{ text-align: center; font-size: 13px; } .co{ text-align: center; font-size: 12px; } .cc{margin-left: 190px;} p{text-align: justify;} img{padding-left: 25px;} .center-text{text-align: center !important;}
    body,div,table,thead,tbody,tfoot,tr,th,td,p { font-family:"Calibri"; font-size:x-small }
    a.comment-indicator:hover + comment { background:#ffd; position:absolute; display:block; border:1px solid black; padding:0.5em;  }
    a.comment-indicator { background:red; display:inline-block; border:1px solid black; width:0.5em; height:0.5em;  }
    comment { display:none;  }
</style>
<body>
    <table border="1" cellspacing="0" cellpadding="0">
        <tbody>
        <tr>
            <td rowspan="3" width="193" height="100">
                <img src="img/1.jpg" width="193" height="130" >
            </td>
            <td rowspan="2">
                <p class="co" style="margin-left: 10px; margin-right: 10px;"><strong>PUNTO VIVE DIGITAL LAB VALLEDUPAR</strong></p>
            </td>
            <td>
                <p class="cod" style="margin-left: 10px; margin-right: 10px;">CÓDIGO: PVDLAB-FOR06</p>
            </td>
        </tr>
        <tr>
            <td>
                <p class="cod">VERSIÓN: 2</p>
            </td>
        </tr>
        <tr>
            <td valign="top">
                <p class="co"><strong>FORMATO DE SALIDA DE EQUIPOS</strong></p>
            </td>
            <td>
                <p class="cod">FECHA: {{ $month }} </p>
            </td>
        </tr>
        </tbody>
    </table>
    <br>
    <table cellspacing="0" border="0">
        <tr>
            <td colspan=4 style="border-top: 1px solid; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="40" align="left" valign=middle><b><font color="#000000">NOMBRE DEL PROYECTO : </font></b>{{ $project->name }}</td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=1 height="40" align="left" valign=middle><b><font color="#000000">FECHA DE SOLICTUD: </font></b>{{ $project->created_at->format('Y-m-d') }}</td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="left" valign=middle><b><font color="#000000">FECHA DE INICIO: </font></b>{{ $project->start }}</td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000" height="40" align="center" valign=middle><b><font color="#000000">TIPO DE PROYECTO:<br>(Se debe escoger una opci&oacute;n de la lista desplegable) </font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=middle><font color="#000000">{{ $project->type }}</font></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="50" align="center" valign=middle><b><font color="#000000">BREVE DESCRIPCI&Oacute;N:<br>(Detalle las caracteristicas basicas del proyecto, asi como la finalidad del mismo, de manera breve. Se puede complementar esta informaci&oacute;n en el caso que aplique con un documento anexo). </font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=middle><font color="#000000">{{ $project->description }}</font></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="40" align="center" valign=middle><b><font color="#000000">ORIGEN DEL PROYECTO <br>(Se debe escoger una opci&oacute;n de la lista desplegable) En el caso de seleccionar otro, usar el siguiente espacio para especificar el origen. </font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=middle><font color="#000000">{{ $project->origin }}</font></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 height="32" align="center" valign=middle><b><font color="#000000">                                                                                                               INTEGRANTES</font></b></td>
        </tr>

            <tr>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="20" align="center" valign=bottom><b><font color="#000000">Nombre</font></b></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom><b><font color="#000000">Correo Electronico</font></b></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom><b><font color="#000000">Celular</font></b></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom><b><font color="#000000">Cedula</font></b></td>
            </tr>
        @foreach($project->members as $member)
            <tr>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="20" align="left" valign=bottom><font color="#000000">{{ $member->full_name }}</font></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom><u><font color="#0563C1">{{ $member->email }}</font></u></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom><font color="#000000">{{ $member->cellphone }}</font></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom><font color="#000000">{{ $member->document }}</font></td>
            </tr>
        @endforeach
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 height="40" align="left" valign=middle><b><font color="#000000">CONTACTO PRINCIPAL :</font></b>&nbsp;<font style="font-size: 5px !important;">{{ $project->beneficiary->email }}</font></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="left" valign=middle><b><font color="#000000">OCUPACI&Oacute;N: </font></b>&nbsp;{{ !is_null($project->beneficiary->occupation) ? $project->beneficiary->occupation : 'NO TIENE OCUPACIÓN' }}</td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="40" align="center" valign=middle><b><font color="#000000">ESTADO <br>(Se debe escoger una opci&oacute;n de la lista desplegable) </font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=middle><font color="#000000">{{ $project->state }}</font></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="40" align="center" valign=middle><b><font color="#000000">CUENTA CON FINANCIACI&Oacute;N EXTERNA</font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=middle><font color="#000000">{{ $project->financing }}</font></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="40" align="center" valign=middle><b><font color="#000000">NOMBRE DE LA ENTIDAD QUE FINANCIA (Solo diligenciar Si aplica)</font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=3 align="center" valign=middle><font color="#000000">{{ !is_null($project->financial_entity) ? $project->financial_entity : 'NO APLICA' }}</font></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=4 height="40" align="left" valign=middle><b><font color="#000000">OBSERVACIONES:</font></b>{{ !is_null($project->financing_description) ? $project->financing_description : 'SIN DESCRIPCIÓN' }}</td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 height="35" align="left" valign=middle><b><font color="#000000">Nombre del solicitante: </font></b> {{ $project->beneficiary->full_name }}</td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="left" valign=middle><b><font color="#000000">Firma solicitante:</font></b></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 height="35" align="left" valign=middle><b><font color="#000000">Revis&oacute;: &nbsp;</font></b>{{ $project->employee->full_name }}<br><strong>(Especificar cargo) : </strong>&nbsp; {{ $project->employee->position->name }}</td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="left" valign=middle><b><font color="#000000">Firma: </font></b></td>
        </tr>
        <tr>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 height="40" align="left" valign=top><b><font color="#000000">CONCEPTO: <br>(Para ser diligenciado exclusivamente por el personal del punto encargado de revisar la solicitud, en este concepto se deber&aacute; especificar si es aprobada o no) </font></b></td>
            <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=2 align="center" valign=middle><b><font color="#000000"><br></font></b>{{ $project->concept }}</td>
        </tr>
    </table>
</body>
</html>
