<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function createProduct(Request $request){
        $request->validate([
            "name" => "required",
            "slug"=>"required",
            "description" => "required",
            "price" => "required",
        ]);

        $created_product = Product::create($request->all());
        return response([
            'status'=>'success',
            'message' =>'Product created successfully',
            'data' => $created_product,
        ]);
    }
}
