<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Employee;
use Illuminate\Http\Request;

// use Image;

// use Intervention\Image\ImageManagerStatic as Image;

class EmployeeController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $employee = Employee::orderBy( 'id', 'desc' )->get();
        return response()->json( $employee );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request ) {

        $validation = $request->validate( [
            'name'  => 'required|unique:employees|max:255',
            'email' => 'required',
            'phone' => 'required|unique:employees',
        ] );

        if ( $request->hasFile( 'img' ) ) {

            $file      = $request->file( 'img' );
            $file_name = time() . '.' . $file->extension();
            $file->move( public_path( 'backend/employee' ), $file_name );

            $employee               = new Employee();
            $employee->email        = $request->input( 'email' );
            $employee->name         = $request->input( 'name' );
            $employee->phone        = $request->input( 'phone' );
            $employee->sallery      = $request->input( 'sallery' );
            $employee->nid          = $request->input( 'nid' );
            $employee->address      = $request->input( 'address' );
            $employee->joining_date = $request->input( 'joining_date' );
            $employee->photo        = asset( "backend/employee/{$file_name}" );
            $employee->save();

        } else {
            $employee               = new Employee();
            $employee->email        = $request->input( 'email' );
            $employee->name         = $request->input( 'name' );
            $employee->phone        = $request->input( 'phone' );
            $employee->sallery      = $request->input( 'sallery' );
            $employee->nid          = $request->input( 'nid' );
            $employee->address      = $request->input( 'address' );
            $employee->joining_date = $request->input( 'joining_date' );
            $employee->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id ) {
        $employee = Employee::where( 'id', $id )->first();
        return response()->json( $employee );
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
            $file->move( public_path( 'backend/employee' ), $file_name );

            $employee = Employee::find( $id );
            // Deleting Old Photo
            $oldPhoto = $employee->photo;
            if ( $oldPhoto ) {
                $photo_url = $oldPhoto;
                $part      = explode( '/', $photo_url );
                $slicedArr = array_slice( $part, 3 );
                $photoStr  = implode( '/', $slicedArr );
                unlink( $photoStr );
            }

            $employee->email        = $request->input( 'email' );
            $employee->name         = $request->input( 'name' );
            $employee->phone        = $request->input( 'phone' );
            $employee->sallery      = $request->input( 'sallery' );
            $employee->nid          = $request->input( 'nid' );
            $employee->address      = $request->input( 'address' );
            $employee->joining_date = $request->input( 'joining_date' );
            $employee->photo        = asset( "backend/employee/{$file_name}" );
            $employee->save();
            return $request;

        } else {
            $employee               = Employee::find( $id );
            $employee->email        = $request->input( 'email' );
            $employee->name         = $request->input( 'name' );
            $employee->phone        = $request->input( 'phone' );
            $employee->sallery      = $request->input( 'sallery' );
            $employee->nid          = $request->input( 'nid' );
            $employee->address      = $request->input( 'address' );
            $employee->joining_date = $request->input( 'joining_date' );
            $employee->photo        = $request->input( 'photo' );
            $employee->save();
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
        $employee = Employee::where( 'id', $id )->first();
        $photo    = $employee->photo;

        if ( $photo ) {
            $photo_url = $photo;
            $part      = explode( '/', $photo_url );
            $slicedArr = array_slice( $part, 3 );
            $photoStr  = implode( '/', $slicedArr );
            unlink( $photoStr );
            Employee::where( 'id', $id )->delete();
        } else {
            Employee::where( 'id', $id )->delete();
        }
    }
}
