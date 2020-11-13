<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PosController extends Controller
{
    public function getProductsByCategory($id){
        $products = Product::where('category_id',$id)->get(); 
        return ProductResource::collection($products);
    }

  
}
