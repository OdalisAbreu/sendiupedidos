<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders['orders'] = Order::all();
        return view('admin.orders.index',$orders)->with('user');
       
    }

    public function show($id)
    {
        //
        $order = Order::findOrFail($id);
        return response()->json($order->load('cart'));
        
    }
    public function editar($id, $status){
       
        // Muestra las ordenes realizadas de todos los usuarios en la parte Web
        DB::table('orders')
                 ->where('id', $id)
                 ->update(['status' => $status]);
        
                 $orders['orders'] = Order::all();
                 return view('admin.orders.index',$orders)->with('user','cart');
    }

    public function order($id, $cart_id){
        //Actualiza el carrito
        DB::table('carts')->where('id',$cart_id)->update(['status'=>'Pending'],['order_date'=> Carbon::now()]);
        //guarda la orden
        $order = new Order();
	    $order->cart_id = $cart_id;
		$order->user_id = $id;
		$order->status = 'Pendiente';
        $order->save();
        
        return $order;
		
    }
}
