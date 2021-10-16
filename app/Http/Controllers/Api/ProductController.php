<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $product = DB::table( 'products' )
            ->join( 'categories', 'products.category_id', '=', 'categories.id' )
            ->join( 'suppliers', 'products.supplier_id', '=', 'suppliers.id' )
            ->select( 'categories.category_name', 'suppliers.name', 'products.*' )
            ->get();
        return response()->json( $product );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request ) {
        $validateData = $request->validate( [
            'product_name'     => 'required|max:255',
            'product_name'     => 'required|max:255|unique:products',
            'category_id'      => 'required',
            'supplier_id'      => 'required',
            'buying_price'     => 'required',
            'selling_price'    => 'required',
            'buying_date'      => 'required',
            'product_quantity' => 'required',
        ] );

        if ( $request->hasFile( 'image' ) ) {

            $file      = $request->file( 'image' );
            $file_name = time() . '.' . $file->extension();
            $file->move( public_path( 'backend/product/' ), $file_name );

            $product                   = new Product();
            $product->product_name     = $request->input( 'product_name' );
            $product->product_code     = $request->input( 'product_code' );
            $product->category_id      = $request->input( 'category_id' );
            $product->supplier_id      = $request->input( 'supplier_id' );
            $product->buyign_price     = $request->input( 'buying_price' );
            $product->selling_price    = $request->input( 'selling_price' );
            $product->buying_date      = $request->input( 'buying_date' );
            $product->product_quantity = $request->input( 'product_quantity' );
            $product->root             = $request->input( 'root' );
            $product->image            = asset( "backend/product/{$file_name}" );
            $product->save();

        } else {
            $product                   = new Product();
            $product->product_name     = $request->input( 'product_name' );
            $product->product_code     = $request->input( 'product_code' );
            $product->category_id      = $request->input( 'category_id' );
            $product->supplier_id      = $request->input( 'supplier_id' );
            $product->buying_price     = $request->input( 'buying_price' );
            $product->selling_price    = $request->input( 'selling_price' );
            $product->buying_date      = $request->input( 'buying_date' );
            $product->product_quantity = $request->input( 'product_quantity' );
            $product->root             = $request->input( 'root' );
            $product->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id ) {
        $product = Product::find( $id );
        return response()->json( $product );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id ) {
        if ( $request->hasFile( 'newimage' ) ) {

            $file      = $request->file( 'newimage' );
            $file_name = time() . '.' . $file->extension();
            $file->move( public_path( 'backend/product/' ), $file_name );

            $product = Product::find( $id );

            $oldPhoto = $product->image;

            if ( $oldPhoto ) {
                $photo_url = $oldPhoto;
                $part      = explode( '/', $photo_url );
                $slicedArr = array_slice( $part, 3 );
                $photoStr  = implode( '/', $slicedArr );
                unlink( $photoStr );
            }

            $product = Product::find( $id );

            $product->product_name     = $request->product_name;
            $product->product_code     = $request->product_code;
            $product->category_id      = $request->category_id;
            $product->supplier_id      = $request->supplier_id;
            $product->buyign_price     = $request->buyign_price;
            $product->selling_price    = $request->selling_price;
            $product->buying_date      = $request->buying_date;
            $product->product_quantity = $request->product_quantity;
            $product->root             = $request->root;
            $product->image            = asset( "backend/product/{$file_name}" );
            $product->save();
            return $request;

        } else {
            $product                   = Product::find( $id );
            $product->product_name     = $request->product_name;
            $product->product_code     = $request->product_code;
            $product->category_id      = $request->category_id;
            $product->supplier_id      = $request->supplier_id;
            $product->buyign_price     = $request->buyign_price;
            $product->selling_price    = $request->selling_price;
            $product->buying_date      = $request->buying_date;
            $product->product_quantity = $request->product_quantity;
            $product->root             = $request->root;
            $product->image            = $request->image;
            $product->save();
            return $request;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id ) {
        $product = Product::find( $id );
        $image   = $product->image;

        if ( $image ) {
            $photo_url = $image;
            $part      = explode( '/', $photo_url );
            $slicedArr = array_slice( $part, 3 );
            $photoStr  = implode( '/', $slicedArr );
            unlink( $photoStr );
            Product::find( $id )->delete();
        } else {
            Product::find( $id )->delete();
        }

    }

    public function stockUpdate( Request $request, $id ) {
        $product                   = Product::find( $id );
        $product->product_quantity = $request->product_quantity;
        $product->save();
    }
}
