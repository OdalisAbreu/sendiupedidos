<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Cart;
use App\CartDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Mail\NewOrder;
use App\Order;
use Mail;

class CartController extends Controller
{
 
 	public function update()
 	{
		$client = auth()->user();
		
		$order = new Order();
	    $order->cart_id = $client->cart->id;
		$order->user_id = $client->cart->user_id;
		$order->status = 'Pendiente';
		$order->save();
		
		$cart = $client->cart;
    	$cart->status = 'Pending';
    	$cart->order_date = Carbon::now();
		$cart->update();      		// UPDATE
 
    	//$admins = User::where('admin', true)->get();
        //Aqui podemos agregar copia del correo para el cliente,
        //para pruebas solo envía al correo del admin
    	//Mail::to($admins)->send(new NewOrder($client, $cart));

    	//$msg = 'Tu pedido se ha registrado correctamente. Te contactaremos pronto vía mail!';
		//return back()->with(compact('msg'));
		return redirect('home');
		
	 }
	 public function crearcarrtito($id, $product_id, $cantidad){
// Validar si esta creado ya el carrito 
		$existe = DB::table('carts')->where([['user_id',$id],['status','Active']])->exists();
		//calcular el total de la factura antes de guardar 

		if($existe){
			/*
	        // Carga un nuevo producto al carrito
			$cart = DB::table('carts')->where([['user_id',$id],['status','Active']])->get();
			$cartDetail = new CartDetail();
			$cartDetail->cart_id = $cart[0]->id;
			$cartDetail->product_id= $product_id;
			$cartDetail->quantity = $cantidad;
			$cartDetail->save();
*/	
		
			return '';
		}else{

			// Crea un nuevo carrito
			$cart = new Cart();
			$cart->user_id = $id;
			$cart->status = 'Active';
			$cart->order_date = Carbon::now();
			$cart->Save(); 
			//carga el primer producto en el carrito
			$cartDetail = new CartDetail();
			$cartDetail->cart_id = $cart->id;
			$cartDetail->product_id= $product_id;
			$cartDetail->quantity = $cantidad;
			$cartDetail->save();
			
			return 'No esta';
		}

	 }
}
