<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-10 ">
            <h1>Factura</h1>
        </div>
        <div class="col-xs-2">
{{--            <img class="img img-responsive" src="./parzibyte.jpg" alt="Logotipo">--}}
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xs-10">
            <h1 class="h6"> Universidad Mayor de San Simon</h1>
            <h1 class="h6"> http://www.fcyt.umss.edu.bo/</h1>
        </div>
        <div class="col-xs-2 text-center">
            <strong>Fecha</strong>
            <br>
             {{ Carbon\Carbon::now()  }}
            <br>
            <strong>Factura No.</strong>
            <br>
             {{$data->id}}
        </div>
    </div>
    <hr>
    <div class="row text-center" style="margin-bottom: 2rem;">
        <div class="col-xs-6">
            <h1 class="h2">Cliente</h1>
            <strong> {{$data->user->name }}</strong>
        </div>
        <div class="col-xs-6">
            <h1 class="h2">Remitente</h1>
            <strong> fcyt.umss.edu.bo </strong>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-condensed table-bordered table-striped">
                <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Fecha de Emision</th>
                    <th>Modalidad de Pago</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td> Pago en relacion al servicio de Parqueo segun la convocatoria {{$data->announcement->fecha_inicio}} / {{$data->announcement->fecha_fin}}</td>
                    <td>{{$data->created_at }}</td>
                    <td>{{$data->plan }}</td>
                    <td>{{$data->amount }} Bs.</td>
                </tr>

                </tbody>
                <tfoot>
                {{--<tr>
                    <td colspan="3" class="text-right">Subtotal</td>
                    <td>$ <?php number_format($subtotal, 2) ?></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">Descuento</td>
                    <td>$ <?php number_format($descuento, 2) ?></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">Subtotal con descuento</td>
                    <td>$ <?php number_format($subtotalConDescuento, 2) ?></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-right">Impuestos</td>
                    <td>$ <?php number_format($impuestos, 2) ?></td>
                </tr>--}}
                <tr>
                    <td colspan="3" class="text-right">
                        <h4>Total</h4></td>
                    <td>
                        <h4>{{$data->amount }} Bs.</h4>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 text-center">
            <p class="h5"> {{$mensajePie }}</p>
        </div>
    </div>
</div>
</body>
</html>
