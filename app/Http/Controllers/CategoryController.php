<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

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
  
    $bot_category = '{ "categories": '.$category->load('products').'}';
    return $bot_category;
  }
  
  public function verproducto($id){
    $category = Category::findOrFail($id);
    return response()->json($category->load('products'));
  }



}
