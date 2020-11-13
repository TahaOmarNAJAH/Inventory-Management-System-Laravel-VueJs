<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PosResource;
use App\Models\Extra;
use App\Models\Pos;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $pos = Pos::where('product_id', $id)->first();
        if ($pos) {
            $pos->increment('quantity', 1);
            $pos->sub_total = $pos->quantity * $product->selling_price;
            $pos->save();
            return response()->json(['message' => 'POS Updated'], Response::HTTP_OK);
        }

        $pos = new Pos();
        $pos->product_id = $id;
        $pos->quantity = 1;
        $pos->sub_total = $product->selling_price;
        $pos->save();
        return response()->json(['message' => 'POS Created'], Response::HTTP_CREATED);
    }

    public function getCartProducts()
    {
        $cart = Pos::all();
        return response()->json(PosResource::collection($cart));
    }

    public function incrementQty($id)
    {
        $pos = Pos::where('id', $id)->first();
        if ($pos) {
            $pos->increment('quantity', 1);
            $pos->sub_total = $pos->quantity * $pos->product->selling_price;
            $pos->save();
            return response()->json(['message' => 'POS Updated'], Response::HTTP_OK);
        }
    }

    public function decrementQty($id)
    {
        $pos = Pos::where('id', $id)->first();
        if ($pos) {
            $pos->decrement('quantity', 1);
            $pos->sub_total = $pos->quantity * $pos->product->selling_price;
            $pos->save();
            return response()->json(['message' => 'POS Updated'], Response::HTTP_OK);
        }
    }

    public function removeItem($id)
    {
        Pos::destroy($id);
    }

    public function vats(){
        $vat = Extra::all()->first();
        return response()->json($vat);
    }
}
