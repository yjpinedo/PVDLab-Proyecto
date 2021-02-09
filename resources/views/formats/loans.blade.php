<!DOCTYPE html>
<html>
<head>
    <title>Formato de salida de equipos</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<style>
    .pa{font-size: 14px;} .cod{ text-align: center; font-size: 13px; } .co{ text-align: center; font-size: 12px; } .cc{margin-left: 190px;} p{text-align: justify;} img{padding-left: 25px;} .center-text{text-align: center !important;}
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
    </table> <br />
    <p>
        I. <strong>DATOS DE IDENTIFICACIÓN DEL SOLICITANTE</strong>:
    </p>
    <table border="1" cellspacing="0" cellpadding="0" width="525">
        <tbody class="center-text">
        <tr>
            <td valign="top"><p><strong>Nombre Completo</strong></p></td>
            <td valign="top"><p><strong>Número de Documento</strong></p></td>
            <td colspan="2" valign="top"><p><strong>Tipo de Usuario</strong></p></td>
        </tr>
        <tr>
            <td valign="top"><p>{{ $beneficiary->full_name }}</p></td>
            <td valign="top"><p>{{ $beneficiary->document }}</p></td>
            <td valign="top" colspan="2"><p>{{ __('Por definir') }}</p></td>
        </tr>
        <tr>
            <td valign="top"><p><strong>Institución</strong></p></td>
            <td valign="top"><p><strong>Teléfono</strong></p></td>
            <td colspan="2" valign="top"><p><strong>Fecha de Solicitud</strong></p></td>
        </tr>
        <tr>
            <td valign="top"><p>{{ $beneficiary->full_name }}</p></td>
            <td valign="top"><p>{{ $beneficiary->cellphone }}</p></td>
            <td colspan="2" valign="top"><p>{{ $loan->created_at->format('Y-m-d') }}</p></td>
        </tr>
        <tr>
            <td valign="top"><p><strong>Descripción de la Actividad</strong></p></td>
            <td valign="top"><p><strong>Lugar</strong></p></td>
            <td colspan="2" valign="top"><p><strong>Fecha de la actividad</strong></p></td>
        </tr>
        <tr>
            <td valign="top"><p>{{ $loan->full_name }}</p></td>
            <td valign="top"><p>{{ $loan->place }}</p></td>
            <td colspan="2" valign="top"><p>{{ __('Por definir') }}</p></td>
        </tr>
        </tbody>
    </table>
    <p>
        II. <strong>DATOS RELATIVOS AL EQUIPO</strong>: (<em>Esta lista debe coincidir con el forma</em> <em>to de
            requerimientos</em> de equipos).
    </p>
    <table border="1" cellspacing="0" cellpadding="0" width="525">
        <thead class="center-text">
            <tr>
                <th valign="top"><p>ARTÍCULO</p></th>
                <th valign="top"><p>MARCA</p></th>
                <th valign="top"><p>MODELO</p></th>
                <th valign="top"><p>SERIAL</p></th>
            </tr>
        </thead>
        <tbody class="center-text">
        <!--<tr>
            <td colspan="2" valign="top">
                <p>
                    <strong> EQUIPO (S) <em></em></strong>
                </p>
            </td>
            <td colspan="2" valign="top">
                <p align="center">
                    FECHA DE PRÉSTAMO
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="2" rowspan="3" valign="top">
                <p>
                    1. Laptop 2. Filmadora 3. Cámara video
                </p>
                <p>
                    4. Cámara video 5. Luz portátil 6.Tripode
                </p>
                <p>
                    7. Micrófonos 8. Audífonos 9. Otro (s)
                </p>
                <p>
                    Si marcó, especificar cuál(es)
                </p>
            </td>
            <td width="265" colspan="2" valign="top">
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top">
                <p align="center">
                    HORA DE PRÉSTAMO
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top">
            </td>
        </tr>-->
        @foreach($loan->articles as $article)
            <tr>
                <td valign="top"><p>{{ $article->name }}</p></td>
                <td valign="top"><p>{{ $article->brand }}</p></td>
                <td valign="top"><p>{{ $article->pattern }}</p></td>
                <td valign="top"><p>{{ $article->serial }}</p></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br>
    <table border="1" cellspacing="0" cellpadding="0" width="525">
        <tbody>
        <tr>
            <td valign="top" style="margin-left: 5px !important;"><p><strong>OBSERVACIONES DE SALIDA:</strong> {{ $loan->description }}</p></td>
        </tr>
        </tbody>
    </table>
    <p style="margin-left: 5%;">
        <strong>
            ______________________________ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;________________________________
        </strong>
    </p>
    <p style="margin-left: 10.5%;">
        <strong> Firma de quien recibe &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma de quien entrega </strong>
    </p>
    <div>
        <hr>
    </div>
    <p>
        <strong>ENTREGA A CONFORMIDAD </strong>
        <em>
            (Información para diligenciar en el momento que son devueltos los
            equipos).
        </em>
    </p>
    <p>
        Fecha de recibido: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hora de recibido: <u></u>
    </p>
    <table border="1" cellspacing="0" cellpadding="0" width="525">
        <tbody>
            <tr>
                <td valign="top" style="margin-left: 5px !important;"><p><strong>OBSERVACIONES DE RECIBIDO:</strong> </p></td>
            </tr>
        </tbody>
    </table>
    <p style="margin-left: 5%;">
        <strong>
            ______________________________ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;________________________________
        </strong>
    </p>
    <p style="margin-left: 10.5%;">
        <strong> Firma de quien recibe &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Firma de quien entrega </strong>
    </p>
    <div>
    </div>
    <p>
        <strong><u>NOTA IMPORTANTE</u></strong>
        : el usuario se compromete a devolver el equipo solicitado en perfectas
        condiciones al PVDLAB VALLEDUPAR, ubicado en la universidad popular del
        cesar sede sabanas, de lo contrario no se emitirá la aprobación de la
        devolución, hasta que se repare o se reponga el equipo. Se debe diligenciar
        adicionalmente, el formato de
    </p>
</body>
</html>
