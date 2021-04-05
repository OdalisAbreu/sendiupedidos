<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;


class OrderController extends Controller
{
   /* public function __construct()
    {
        $this->middleware('auth');
    }*/

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

    /* public function show($id)
    {
        //
        $order = Order::findOrFail($id);
        return response()->json($order->load('cart'));
        
    }*/
    public function editar($id, $status){
       
        // Muestra las ordenes realizadas de todos los usuarios en la parte Web
        DB::table('orders')
                 ->where('id', $id)
                 ->update(['status' => $status]);
        
                 $orders['orders'] = Order::all();
                 return view('admin.orders.index',$orders)->with('user','cart');
    }

    public function order($id, $cart_id, $direction_id){
        //Actualiza el carrito
        DB::table('carts')->where('id',$cart_id)->update(['status'=>'Pending'],['order_date'=> Carbon::now()]);
        //guarda la orden
        $order = new Order();
	    $order->cart_id = $cart_id;
		$order->user_id = $id;
		$order->status = 'Pendiente';
        $order->direction_id = $direction_id;
        $order->save();
        
        return $order;
		
    }

    public function orderuser($user_id){
        $ids ="";
        $existe = DB::table('orders')->where('user_id', $user_id)->exists();
        
        if ($existe){
            $user_order = DB::table('orders')->where('user_id', $user_id)->get();
    
            foreach ($user_order as $order){
                $ids .= ', '.$order->id;
            }
            return '{ "mensaje": "Su(s) número(s) de orden(es) '.$ids.'"}';
        }else{
            return '{ "mensaje": "nulo"}';
        }
       // return response()->json($user_order);
    }

    public function vieworder($user_id, $order_id){
        $user_order = DB::table('orders')->where(['user_id'=>$user_id,'id'=>$order_id])->get();
        return response()->json($user_order);
    }

    public function updatedirrection($order_id, $direction_id){
        DB::table('orders')->where('id',$order_id)->update(['direction_id'=>$direction_id]);

        return '{ "mensaje": "Update complete"}';
    }


}
