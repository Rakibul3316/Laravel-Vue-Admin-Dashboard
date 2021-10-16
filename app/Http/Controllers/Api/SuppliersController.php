<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Supplier;
use Illuminate\Http\Request;

class SuppliersController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $suppliers = Supplier::all();
        return response()->json( $suppliers );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request ) {
        $validationData = $request->validate( [
            'name'  => 'required|max:255|unique:suppliers',
            'email' => 'required|',
            'phone' => 'required|unique:suppliers',
        ] );

        if ( $request->hasFile( 'img' ) ) {
            $file      = $request->file( 'img' );
            $file_name = time() . '.' . $file->extension();
            $file->move( public_path( 'backend/supplier/' ), $file_name );

            $supplier = new Supplier();

            $supplier->name     = $request->name;
            $supplier->email    = $request->email;
            $supplier->address  = $request->address;
            $supplier->phone    = $request->phone;
            $supplier->shopname = $request->shopname;
            $supplier->photo    = asset( "backend/supplier/{$file_name}" );
            $supplier->save();
            return $request;
        } else {
            $supplier = new Supplier();

            $supplier->name     = $request->name;
            $supplier->email    = $request->email;
            $supplier->address  = $request->address;
            $supplier->phone    = $request->phone;
            $supplier->shopname = $request->shopname;
            $supplier->save();
            return $request;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id ) {
        $supplier = Supplier::find( $id );
        return response()->json( $supplier );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id ) {
        if ( $request->hasFile( 'newphoto' ) ) {

            $file      = $request->file( 'newphoto' );
            $file_name = time() . '.' . $file->extension();
            $file->move( public_path( 'backend/supplier/' ), $file_name );

            $supplier = Supplier::find( $id );

            $oldPhoto = $supplier->photo;

            if ( $oldPhoto ) {
                $photo_url = $oldPhoto;
                $part      = explode( '/', $photo_url );
                $slicedArr = array_slice( $part, 3 );
                $photoStr  = implode( '/', $slicedArr );
                unlink( $photoStr );
            }

            $supplier->name     = $request->name;
            $supplier->email    = $request->email;
            $supplier->address  = $request->address;
            $supplier->phone    = $request->phone;
            $supplier->shopname = $request->shopname;
            $supplier->photo    = asset( "backend/supplier/{$file_name}" );
            $supplier->save();
            return $request;
        } else {
            $supplier = Supplier::find( $id );

            $supplier->name     = $request->name;
            $supplier->email    = $request->email;
            $supplier->address  = $request->address;
            $supplier->phone    = $request->phone;
            $supplier->shopname = $request->shopname;
            $supplier->photo    = $request->photo;
            $supplier->save();
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
        $supplier = Supplier::find( $id );
        $photo    = $supplier->photo;

        if ( $photo ) {
            $photo_url = $photo;
            $part      = explode( '/', $photo_url );
            $slicedArr = array_slice( $part, 3 );
            $photoStr  = implode( '/', $slicedArr );
            unlink( $photoStr );
            Supplier::find( $id )->delete();
        } else {
            Supplier::find( $id )->delete();
        }
    }
}
