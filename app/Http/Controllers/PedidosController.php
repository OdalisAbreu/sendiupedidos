<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Order;


class PedidosController extends Controller
{
 /*   public function exportPdf()
    {
        $orders['orders'] = Order::get();
        $pdf = PDF::loadView('pdf.order', $orders)->with('user','cart' );

        return $pdf->download('order.pdf');;
    }*/

    public function show($id)
    {
        //
        $orders['orders'] = Order::find($id);
        return view('pdf.order',$orders)->with('user','cart' );
//        $orders = Order::find($id);
//        return view('pdf.order',$orders)->with('cart');
        
    }
}
