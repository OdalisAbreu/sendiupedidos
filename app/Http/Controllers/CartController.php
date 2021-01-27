<?php

namespace App\Http\Controllers;

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
	 
}
