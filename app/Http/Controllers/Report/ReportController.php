<?php

namespace App\Http\Controllers\Report;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Purchase;
use App\Report;
use App\Sale;
use App\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 
    
    public function purchaseindex(){
        $supplier = Supplier::all();
        return view('report.index', compact('supplier'));
    }

    public function purchsestore(Request $request){
        $validatedData = $request->validate([
            'fromdate' => 'required',
            'todate' => 'required',
            'supplier_id' => 'required',
        ]);



        if($request->isMethod('post')){
            $data = $request->all();


            $purchasereport = Purchase::where('supplier_id','=',$data['supplier_id'])
                ->where('ostatus' ,'!=',3)
                ->whereDate('created_at','<=',$data['todate'])
                ->whereDate('created_at','>=',$data['fromdate'])->get();

                // $productdata = json_decode(json_encode($purchasereport),true);
                // echo "<pre>";print_r($productdata);
                $supplier = Supplier::all();

                return view('report.index', compact('purchasereport','supplier'));
        }

        
        

        // print_r($supplierid); 
        // die();

       

        // $supplier = Supplier::all();
        // $productdata = json_decode(json_encode($purchasereport),true);
        // echo "<pre>";print_r($productdata);

        
    }

    public function purchsereturn(){
        $supplier = Supplier::all();
        return view('report.purchasereturn', compact('supplier'));
    }

    public function purchsereturnstore(Request $request){
        $validatedData = $request->validate([
            'fromdate' => 'required',
            'todate' => 'required',
            'supplier_id' => 'required',
        ]);



        if($request->isMethod('post')){
            $data = $request->all();


            $purchasereport = Purchase::where('supplier_id','=',$data['supplier_id'])
                ->where('ostatus' ,'=',3)
                ->whereDate('created_at','<=',$data['todate'])
                ->whereDate('created_at','>=',$data['fromdate'])->get();

                // $productdata = json_decode(json_encode($purchasereport),true);
                // echo "<pre>";print_r($productdata);
                $supplier = Supplier::all();

                return view('report.index', compact('purchasereport','supplier'));
        }

        
        

        // print_r($supplierid); 
        // die();

       

        // $supplier = Supplier::all();
        // $productdata = json_decode(json_encode($purchasereport),true);
        // echo "<pre>";print_r($productdata);

        
    }

    public function salesindex(){
        $customer = Customer::all();
        return view('report.sales', compact('customer'));
    }


    public function salesstore(Request $request){
        // $validatedData = $request->validate([
        //     'fromdate' => 'required',
        //     'todate' => 'required',
        //     'supplier_id' => 'required',
        // ]);

       

       if ($request->isMethod('post')) {
            
        $data = $request->all();
        

            $salesreport = Sale::where('customer_id', '=', $data['customer_id'])
                ->where('ostatus' ,'!=',3)
                ->whereDate('created_at', '<=', $data['todate'])
                ->whereDate('created_at', '>=', $data['fromdate'])->get();


            // $productdata = json_decode(json_encode($salesreport),true);
            // echo "<pre>";print_r($productdata); 

           
            $customer = Customer::all();

            return view('report.sales', compact('salesreport', 'customer'));
        }

        
    }


    public function salesreturn(){
        $customer = Customer::all();
        return view('report.salereturn', compact('customer'));
    }


    public function salesreturnstore(Request $request){
        // $validatedData = $request->validate([
        //     'fromdate' => 'required',
        //     'todate' => 'required',
        //     'supplier_id' => 'required',
        // ]);

       

       if ($request->isMethod('post')) {
            
        $data = $request->all();
        

            $salesreport = Sale::where('customer_id', '=', $data['customer_id'])
                ->where('ostatus' ,'=',3)
                ->whereDate('created_at', '<=', $data['todate'])
                ->whereDate('created_at', '>=', $data['fromdate'])->get();


            // $productdata = json_decode(json_encode($salesreport),true);
            // echo "<pre>";print_r($productdata); 

           
            $customer = Customer::all();

            return view('report.salereturn', compact('salesreport', 'customer'));
        }

        
    }

}
