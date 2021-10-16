<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Expense;
use Illuminate\Http\Request;

class ExpensController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $expense = Expense::all();
        return response()->json( $expense );
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
        $validateDate = $request->validate( [
            'details' => 'required',
            'amount'  => 'required',
        ] );
        $expense = new Expense();

        $expense->amout        = $request->amount;
        $expense->details      = $request->details;
        $expense->expense_date = date( 'd/m/y' );

        $expense->save();
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id ) {
        $expense = Expense::find( $id );
        return response()->json( $expense );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id ) {
        $expense = Expense::find( $id );

        $expense->amout        = $request->amount;
        $expense->details      = $request->details;
        $expense->expense_date = date( 'd/m/y' );
        $expense->save();

        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id ) {
        //
    }
}
