<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $customer = Customer::all();
        return response()->json( $customer );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request ) {
        $validateData = $request->validate( [
            'name'  => 'required|unique:customers',
            'email' => 'required',
            'phone' => 'required|unique:customers',
        ] );

        if ( $request->hasFile( 'image' ) ) {

            $file      = $request->file( 'image' );
            $file_name = time() . '.' . $file->extension();
            $file->move( public_path( 'backend/customer/' ), $file_name );

            $customer          = new Customer();
            $customer->name    = $request->input( 'name' );
            $customer->email   = $request->input( 'email' );
            $customer->phone   = $request->input( 'phone' );
            $customer->address = $request->input( 'address' );
            $customer->photo   = asset( "backend/customer/{$file_name}" );
            $customer->save();

        } else {
            $customer          = new Customer();
            $customer->name    = $request->input( 'name' );
            $customer->email   = $request->input( 'email' );
            $customer->phone   = $request->input( 'phone' );
            $customer->address = $request->input( 'address' );
            $customer->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id ) {
        $customer = Customer::find( $id );
        return response()->json( $customer );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id ) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id ) {
        if ( $request->hasFile( 'new_image' ) ) {

            $file      = $request->file( 'new_image' );
            $file_name = time() . '.' . $file->extension();
            $file->move( public_path( 'backend/customer/' ), $file_name );

            $customer = Customer::find( $id );

            $oldPhoto = $customer->photo;

            if ( $oldPhoto ) {
                $photo_url = $oldPhoto;
                $part      = explode( '/', $photo_url );
                $slicedArr = array_slice( $part, 3 );
                $photoStr  = implode( '/', $slicedArr );
                unlink( $photoStr );
            }
            $customer->name    = $request->input( 'name' );
            $customer->email   = $request->input( 'email' );
            $customer->phone   = $request->input( 'phone' );
            $customer->address = $request->input( 'address' );
            $customer->photo   = asset( "backend/customer/{$file_name}" );
            $customer->save();

        } else {
            $customer          = Customer::find( $id );
            $customer->name    = $request->input( 'name' );
            $customer->email   = $request->input( 'email' );
            $customer->phone   = $request->input( 'phone' );
            $customer->address = $request->input( 'address' );
            $customer->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id ) {
        $customer = Customer::find( $id );
        $photo    = $customer->photo;

        if ( $photo ) {
            $photo_url = $photo;
            $part      = explode( '/', $photo_url );
            $slicedArr = array_slice( $part, 3 );
            $photoStr  = implode( '/', $slicedArr );
            unlink( $photoStr );
            Customer::find( $id )->delete();
        } else {
            Customer::find( $id )->delete();
        }
    }
}
