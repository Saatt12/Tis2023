<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->


<html >
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>


<head>

    <title>Membrecia IDP </title>
</head>


<style type="text/css">
    body{
        font-family: sans-serif;
        font-size: 12px;
        height: 50%;
        padding: 0px 0px 0px 0px;
        margin-top: -10px;
    }
    b{
        font-family: sans-serif;
    }
    .cuerpo tr td{

        border-collapse: collapse;
        border-top: 1px dotted rgb(0,0,0);
        border-bottom: 1px dotted rgb(0,0,0);
        border-left: 1px dotted rgb(0,0,0);
        border-right: 1px dotted rgb(0,0,0);
        border-left: none;
        border-bottom: none;
    }
    header {
        position: fixed;
        top: -60px;
        left: 0px;
        right: 0px;
        height: 50px;

        /** Extra personal styles **/
        background-color: #03a9f4;
        color: white;
        text-align: center;
        line-height: 35px;
    }
</style>
<body>
<div class="main">
    <table class="cuerpoo" align="left" cellpadding="0" cellspacing="0" width="100%" style="margin:5px;  page-break-inside: avoid;width:100%;" >
        <tr  classname="trini" style="font-size: 12px; text-align:left;">
            <td style="width: 40%;">
                <table>
                    <tbody>
                    <tr >
                        {{--<td>
                            <img style="width: 60px;height: 100px" src="{{$image_escudo}}"/>
                        </td>--}}
                       {{-- <td>
                            <p style="color: rgb(10, 1, 59); text-align:center;  border-bottom: 1px solid rgb(114, 114, 114);">{{   $setting['name_system']->value }}</p>
                            <p >{{   $setting['detail_system']->value }}</p>
                        </td>--}}
                    </tr>
                    </tbody>
                </table>

            </td>
            <td style="width: 30%"></td>
            <td  style="width: 30%;">
                <p style="text-align: center;"><b>PARQUEO UMSS </b></p>
               {{-- <p style="margin-top:-5px; text-align: center;"> <b>E-mail:</b> {{@$contacto->correo}}</p>
                <p style="margin-top:-10px; text-align: center;"> <b>Telefono:</b> {{@$contacto->telefono}} {{@$contacto->celular && @$contacto->telefono?'-':''}} {{@$contacto->celular}}</p>
        --}}    </td>
        </tr>
    </table>
   {{-- @if(count($result_month)===0)
        <table class="cuerpo" align="left" cellpadding="0" cellspacing="0" width="100%" style="margin:5px;  page-break-inside: avoid;width:100%; border-left: 1px dotted rgb(0,0,0); border-top: 1px dotted rgb(0,0,0);border-bottom: 1px dotted rgb(0,0,0);border-right: 1px dotted rgb(0,0,0)" >
            <thead class="table-info">
            <tr>
                <th colspan="5" >
                    <h3 class="h2" px solid rgb(0,0,0); color: rgb(10, 1, 59);">RESUMEN DE LOS EGRESOS MENSUALES {{strtoupper($months_names[$month-1])}} - {{$gestion}}</h3>
                </th>
            </tr>
            </thead>
        </table>
    @endif--}}

    {{--@foreach($data as $key=>$element)
    --}}    <div class="table-responsive pb-2" >
            <table  class="cuerpo" align="left" cellpadding="0" cellspacing="0" width="100%" style="margin:5px;  page-break-inside: avoid;width:100%; border-left: 1px dotted rgb(0,0,0); border-top: 1px dotted rgb(0,0,0);border-bottom: 1px dotted rgb(0,0,0);border-right: 1px dotted rgb(0,0,0)" >
                <thead class="table-info">
                <tr>
                    <th colspan="2" >
                        <h3 class="h2" style="text-align:center; margin-top: 0%; padding-top: 0%; border: 1px solid rgb(0,0,0); color: rgb(10, 1, 59);">Pagos</h3>
                    </th>
                </tr>

                <tr>
{{--                    <th colspan="5" style="border: 1px dotted rgb(0,0,0); background-color: #bee5eb;">{{$data_destino->destino_name}}</th>--}}
                </tr>
                <tr>

                    <th>Nombre</th>
                    <th>Estado</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as  $key => $item)
                    <tr>
                        <td>{{$item->user->name}}</td>
                        <td>{{@$item->status?$item->status:'Pendiente'}}</td>
                    </tr>
                @endforeach
                </tbody>
               {{-- <tfoot>
                <td colspan="4" style=" text-transform: uppercase;font-weight:700; border-top: 1px dotted rgb(0,0,0)">Total</td>
                <td style="color: red; text-align: right; text-transform: uppercase;font-weight:700; border-top: 1px dotted rgb(0,0,0)   ">{{number_format($data_destino->total, 2, '.', '')}}</td>
                </tfoot>--}}
            </table>
        </div>
{{--    @endforeach--}}
</div>
{{--<div style="page-break-after:always;"></div>--}}
</div>
</body>
