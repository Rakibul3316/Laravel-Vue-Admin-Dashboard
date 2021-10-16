<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller {
    public function paid( Request $request, $id ) {
        $validateData = $request->validate( [
            'month' => 'required',
        ] );

        $month = $request->month;
        $check = Salary::where( 'employee_id', $id )->where( 'salary_month', $month )->first();
        if ( $check ) {
            return response()->json( 'Salary Already Paid' );
        } else {
            $salary = new Salary();

            $salary->employee_id  = $id;
            $salary->amount       = $request->sallery;
            $salary->salary_date  = date( 'd/m/Y' );
            $salary->salary_month = $month;
            $salary->salary_year  = date( 'Y' );
            $salary->save();
        }
    }

    public function allSalary() {
        $month = Salary::select( 'salary_month' )->groupBy( 'salary_month' )->get();
        return response()->json( $month );
    }

    public function viewSalary( $id ) {
        $month = $id;
        $view  = DB::table( 'salaries' )
            ->join( 'employees', 'salaries.employee_id', 'employees.id' )
            ->select( 'employees.name', 'salaries.*' )
            ->where( 'salaries.salary_month', $month )
            ->get();
        return response()->json( $view );
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id ) {
        //
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
        //
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
