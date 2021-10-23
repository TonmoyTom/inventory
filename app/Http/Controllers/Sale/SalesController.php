<?php

namespace App\Http\Controllers\Sale;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Product;
use App\Color;
use App\Attribute;
use App\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 

    public function index(){
        $product = Product::all();
        return view('sales.sales',compact('product'));
    }

    public function view($id){
        $ids =  Crypt::decrypt($id);
        $color = Color::where('product_id',$ids)->get();
        $product =Product::with('attributes')->findOrFail($ids);
        $attribute = Attribute::where('product_id',$ids)->get();
        $customer = Customer::all();
        

        // $productdata = json_decode(json_encode($attribute),true);
        // echo "<pre>";print_r($productdata);
        return view('sales.addsales',compact('product','customer','color','attribute'));
    }


    public function getPrice(Request $request){
        if($request->ajax()){
            $data = $request->all();
            //  echo "<pre>"; print_r($data); die;

            // if($data['size'] == NULL){
                $getPrice = Attribute::where(["product_id" => $data['product_id'],"colorid" => $data['colorid'], "size" => $data['size']])->first();
            // }else{
            //     $getPrice = Attribute::where(["product_id" => $data['product_id'], "size" => $data['size']])->first();
            // }
            // print_r($getPrice);
        //      $productdata = json_decode(json_encode($getPrice),true);
        // echo "<pre>";print_r($productdata);
         
            return $getPrice->price;
        }
        
    }

    public function getcolorPrice(Request $request){
        if($request->ajax()){
            $data = $request->all();
            //  echo "<pre>"; print_r($data); die;
            $getPrice = Attribute::where(["product_id" => $data['product_id'], "colorid" => $data['colorid']])->first();
            // print_r($getPrice);

            return $getPrice->price;
        }
        
    }


    public function store(Request $request){
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'ostatus' => 'required',
            'colorid' => 'required',
            'customer_qty' => 'required',
            'totalprice' => 'required',
            'type' => 'required',
            'note' => 'required',
        ]);

        $sale = new Sale();
        $sale->product_name = $request->product_name;
        $sale->product_id = $request->product_id;
        $sale->product_code = $request->product_code;
        $sale->customer_id = $request->customer_id;
        $sale->ostatus = $request->ostatus;
        $sale->whole_price = $request->whole_price;
        $sale->color_id = $request->colorid;
        $sale->attribute_size = $request->attribute_size;
        $sale->customer_qty = $request->customer_qty;
        $sale->productprice = $request->productprice;
        $sale->totalprice = $request->totalprice;
        $sale->type = $request->type;
        $sale->note = $request->note;

        // $expensedata = json_decode(json_encode($sale),true);
        // echo "<pre>";print_r($expensedata);
        $sale->save();

        $notification=array(
            'messege'=>'Purchase Insert successfully!',
            'alert-type'=>'success'
             );
           return Redirect()->route('sales.all')->with($notification);
    }

    
    public function allview(){

        // $purchase = DB::table('purchases')
        // ->join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
        // ->join('products', 'purchases.product_id', '=', 'products.id')
        // ->select('purchases.*', 'suppliers.*', 'products.*')
        // ->get();

        $sale = Sale::with(['product','customer','color'])->get();
        
        
        // $productdata = json_decode(json_encode($sale),true);
        // echo "<pre>";print_r($productdata);
        return view('sales.index', compact('sale'));
    }


    public function salesupdate($id,$productid){

        
        $ids =  Crypt::decrypt($id);
        $productids =  Crypt::decrypt($productid);
        $customer = Customer::all();
        $color = Color::where('product_id',$productids)->get();
        $product = Attribute::all();    
        $sale = Sale::with(['product','customer','color'])->findOrFail($ids);
        // $productdata = json_decode(json_encode($sale),true);
        // echo "<pre>";print_r($productdata);
        return view('sales.update', compact('sale','customer','product','color'));
    }


    public function salesupdatestore(Request $request,$id,$productid){
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'ostatus' => 'required',
            'colorid' => 'required',
            'customer_qty' => 'required',
            'totalprice' => 'required',
            'type' => 'required',
            'note' => 'required',
        ]);
        $ids =  Crypt::decrypt($id);
        $productids =  Crypt::decrypt($productid);
        $sale =  Sale::findOrFail($ids);
        $sale->product_name = $request->product_name;
        $sale->product_id = $productids;
        $sale->product_code = $request->product_code;
        $sale->customer_id = $request->customer_id;
        $sale->ostatus = $request->ostatus;
        $sale->whole_price = $request->whole_price;
        $sale->color_id = $request->colorid;
        $sale->attribute_size = $request->attribute_size;
        $sale->customer_qty = $request->customer_qty;
        $sale->productprice = $request->productprice;
        $sale->totalprice = $request->totalprice;
        $sale->type = $request->type;
        $sale->note = $request->note;

        // $expensedata = json_decode(json_encode($sale),true);
        // echo "<pre>";print_r($expensedata);
        $sale->save();

        $notification=array(
            'messege'=>'Sale Update successfully!',
            'alert-type'=>'success'
             );

             if( $sale->ostatus == 3){
                return Redirect()->route('sales.return')->with($notification);
             }else{
                return Redirect()->route('sales.all')->with($notification);
             }
          
    }


    public function salesdelete(Request $request ,$id){

        $ids =  Crypt::decrypt($id);
        $expense = Sale::findOrFail($ids)->delete();
        $notification=array(
            'messege'=>'Delete  successfully!',
            'alert-type'=>'success'
             );
           return Redirect()->route('sales.all')->with($notification);
    }


    public function return(){

        // $purchase = DB::table('purchases')
        // ->join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
        // ->join('products', 'purchases.product_id', '=', 'products.id')
        // ->select('purchases.*', 'suppliers.*', 'products.*')
        // ->get();

        $sale = Sale::with(['product','customer','color'])->get();
        
        
        $productdata = json_decode(json_encode($sale),true);
        // echo "<pre>";print_r($productdata);
        return view('sales.return', compact('sale'));
    }


    public function salecolorsize(Request $request){
        if($request->ajax()){
            $data = $request->all();
             $data['getcolorsize'] = Attribute::where(["product_id" => $data['product_id'], "colorid" => $data['colorid']])->get();
            //  $expensedata = json_decode(json_encode($getcolorsize),true);
            //  echo "<pre>"; print_r($expensedata); die;
            return response()->json($data);
        }
    }


    
    // public function coloredit(Request $request, $id){
    //     if($request->ajax()){
    //         $data = $request->all();
    //         echo "<pre>";print_r($data); die();
    //         //  $data['getcolorsize'] = Attribute::where(["product_id" => $data['product_id'], "colorid" => $data['colorid']])->get();
    //         //  $expensedata = json_decode(json_encode($getcolorsize),true);
    //         //  echo "<pre>"; print_r($expensedata); die;
    //         // return response()->json($data);
    //     }
    // }


    


}
