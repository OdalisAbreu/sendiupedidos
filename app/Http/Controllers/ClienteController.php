<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class ClienteController extends Controller
{
    public function crearcliente($name, $email, $phone, $address){

      $existe = DB::table('users')->where('email',$email)->exists();

      if ($existe){
        $mensaje = '{ "mensaje": "Creado"}';
        return $mensaje;
      }else{
          DB::table('users')->insert([
            ['name'=>$name, 'email'=>$email, 'phone' =>$phone, 'address' =>$address, 'password' =>bcrypt($phone)]
          ]);
    
          $user = DB::table('users')->where('phone', $phone)->get();
          return response()->json($user);
      }

    }

    public function existecliente($phone){
        $existe = DB::table('users')->where('phone',$phone)->exists();
        if($existe){
            $user = DB::table('users')->where('phone', $phone)->get();
           return response()->json($user);
        }else{
            $mensaje = '{ "id": 0, "name": "NULL"}';
        return $mensaje;
        }
  
    }

}
