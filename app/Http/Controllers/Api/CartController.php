<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller {
    public function addToCart( Request $request, $id ) {
        $product = Product::find( $id );

        $check = DB::table( 'poses' )->where( 'pro_id', $id )->first();

        if ( $check ) {
            DB::table( 'poses' )->where( 'pro_id', $id )->increment( 'pro_quantity' );

            $product  = DB::table( 'poses' )->where( 'pro_id', $id )->first();
            $quantity = floatval( $product->pro_quantity );
            $price    = floatval( $product->product_price );
            $subTotal = $quantity * $price;

            DB::table( 'poses' )->where( 'pro_id', $id )->update( ['sub_total' => $subTotal] );
        } else {
            $data                  = [];
            $data['pro_id']        = $id;
            $data['pro_name']      = $product->product_name;
            $data['pro_quantity']  = 1;
            $data['product_price'] = $product->selling_price;
            $data['sub_total']     = $product->selling_price;
            DB::table( 'poses' )->insert( $data );
        }
    }

    public function cartProduct() {
        $cart = DB::table( 'poses' )->get();
        return response()->json( $cart );
    }

    public function removeCart( $id ) {
        DB::table( 'poses' )->where( 'id', $id )->delete();
        return response( 'Done' );
    }

    public function increment( $id ) {
        $quantity = DB::table( 'poses' )->where( 'id', $id )->increment( 'pro_quantity' );

        $product  = DB::table( 'poses' )->where( 'id', $id )->first();
        $quantity = floatval( $product->pro_quantity );
        $price    = floatval( $product->product_price );
        $subTotal = $quantity * $price;

        DB::table( 'poses' )->where( 'id', $id )->update( ['sub_total' => $subTotal] );
        return response( 'Done' );
    }

    public function decrement( $id ) {
        $quantity = DB::table( 'poses' )->where( 'id', $id )->decrement( 'pro_quantity' );

        $product  = DB::table( 'poses' )->where( 'id', $id )->first();
        $quantity = floatval( $product->pro_quantity );
        $price    = floatval( $product->product_price );
        $subTotal = $quantity * $price;

        DB::table( 'poses' )->where( 'id', $id )->update( ['sub_total' => $subTotal] );
        return response( 'Done' );
    }

    public function vats() {
        $vat = DB::table( 'extra' )->first();
        return response()->json( $vat );
    }
}
