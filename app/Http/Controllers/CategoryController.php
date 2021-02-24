<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    
  public function show(Category $category)
  {
  			$products = $category->products()->paginate(10);
  		    return view('categories.show')->with(compact('category','products'));
  }
  public function index()
  {
    $category = Category::all();
   // return response()->json($category->load('products'));
  
    $bot_category = '{ "categories": '.$category.'}';
    return $bot_category;
  }
  
  public function verproducto($id){
   // $category = Category::findOrFail($id);
   // return response()->json($category->load('products'));
      $products = DB::table('categories')
                  ->join('products', 'products.category_id','=','categories.id')
                  ->join('product_images','product_images.product_id', '=','products.id')
                  ->where('categories.id', $id)
                  ->select('categories.name','products.id','products.name','products.price','product_images.image')
                  ->get();
      return '{ "products": '.$products.'}';
  }



}
