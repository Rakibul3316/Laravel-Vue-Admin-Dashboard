<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Product;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// use Illuminate\Http\Client\Request;
// use Illuminate\Support\Facades\Request;

class PosController extends Controller {
    public function getProduct( $id ) {
        $product = Product::where( 'category_id', $id )->get();
        return response()->json( $product );
    }

    public function orderDone( Request $request ) {
        $validateData = $request->validate( [
            'customer_id' => 'required',
            'payby'       => 'required',
        ] );

        $data                = [];
        $data['customer_id'] = $request->customer_id;
        $data['qty']         = $request->quantity;
        $data['sub_total']   = $request->subtotal;
        $data['vat']         = $request->vat;
        $data['total']       = $request->total;
        $data['pay']         = $request->pay;
        $data['due']         = $request->due;
        $data['payby']       = $request->payby;
        $data['order_date']  = date( 'd/m/Y' );
        $data['order_month'] = date( 'F' );
        $data['order_year']  = date( 'Y' );

        $order_id = DB::table( 'orders' )->insertGetId( $data );

        $posDatas = DB::table( 'poses' )->get();

        $oderDetails = [];
        foreach ( $posDatas as $posData ) {
            $oderDetails['order_id']      = $order_id;
            $oderDetails['product_id']    = $posData->pro_id;
            $oderDetails['pro_quantity']  = $posData->pro_quantity;
            $oderDetails['product_price'] = $posData->product_price;
            $oderDetails['sub_total']     = $posData->sub_total;
            DB::table( 'order_details' )->insert( $oderDetails );

            DB::table( 'products' )
                ->where( 'id', $posData->pro_id )
                ->update( ['product_quantity' => DB::raw( 'product_quantity -' . $posData->pro_quantity )] );
        }
        DB::table( 'poses' )->delete();
        return response( 'Done' );
    }

    public function searchOrderDate( Request $request ) {
        $orderDate = $request->date;
        $newDate   = new DateTime( $orderDate );
        $done      = $newDate->format( 'd/m/Y' );

        $order = DB::table( 'orders' )
            ->join( 'customers', 'orders.customer_id', 'customers.id' )
            ->select( 'customers.name', 'orders.*' )
            ->where( 'orders.order_date', $done )
            ->get();
        return response()->json( $order );
    }

    public function todaySell() {
        $date = date( 'd/m/Y' );
        $sell = DB::table( 'orders' )->where( 'order_date', $date )->sum( 'total' );
        return response()->json( $sell );
    }

    public function todayIncome() {
        $date   = date( 'd/m/Y' );
        $income = DB::table( 'orders' )->where( 'order_date', $date )->sum( 'sub_total' );
        return response()->json( $income );
    }

    public function todayDue() {
        $date = date( 'd/m/Y' );
        $due  = DB::table( 'orders' )->where( 'order_date', $date )->sum( 'due' );
        return response()->json( $due );
    }

    public function todayExpense() {
        $date    = date( 'd/m/Y' );
        $expense = DB::table( 'expenses' )->where( 'expense_date', $date )->sum( 'amout' );
        return response()->json( $expense );
    }

    public function todayStockout() {
        $product = DB::table( 'products' )->where( 'product_quantity', '<', '1' )->get();
        return response()->json( $product );
    }
}
