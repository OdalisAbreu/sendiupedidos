@extends('layouts.app')

@section('title', 'Listado de productos')

@section('body-class', 'product-page')


@section('content')

<div class="header header-filter" style="background-image: url({{ asset('/img/bg1.jpg')}});">
</div>
<div class="main main-raised">
    <div class="container">
        <div class="section text-center">
            <table class="table table-success table-striped">
                <tr>
                    <th class="col-2 text-center"> Orden </th>
                    <th class="col-2 text-center"> Status </th>
                    <th class="col-2 text-center"> Nombre </th>
                    <th class="col-2 text-center"> Monto </th>
                    <th class="col-4 text-center"> Opciones </th>
                </tr>
                @foreach ($orders as $order)
                <tr>
                    <td class="col-2"> <a href="{{ url('order/'.$order->id)}}"> Orden N. {{$order->id}} </a> </td>
                    <td class="col-2">{{$order->status}}</td>
                    <td class="col-2">{{$order->user->name}}</td>
                    <td class="col-2">{{$order->cart->total}}</td>
                    <td class="col-4">
                        <a href="{{ url('orders/'.$order->id.'/Facturado')}}" class="btn btn-warning"> Facturado </a>
                        | 
                        <a href="{{ url('orders/'.$order->id.'/Pagado')}}" class="btn btn-info"> Pagado </a>
                        |  
                        <a href="{{ url('orders/'.$order->id.'/Despachado')}}" class="btn btn-success"> Despachado </a>
                        |
                        <a href="{{ url('orders/'.$order->id.'/Cancelado')}}" class="btn btn-danger"> Cancelar </a> 
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>



@include('includes.footer')
@endsection