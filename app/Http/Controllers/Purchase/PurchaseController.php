<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Product;
use App\Purchase;
use App\Supplier;
use App\Color;
use App\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 


    public function index(){
        $product = Product::all();
        return view('purchase.purchase',compact('product'));
    }

    public function view($id){
        $ids =  Crypt::decrypt($id);
        $color = Color::where('product_id',$ids)->get();
        $product =Product::with('attributes')->findOrFail($ids);
        $attribute = Attribute::where('product_id',$ids)->get();
        $supplier = Supplier::all();
        // $attrubte = Attrbute::
        return view('purchase.addpurchase',compact('product','supplier','color','attribute'));
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'supplier_id' => 'required',
            'ostatus' => 'required',
            'colorid' => 'required',
            'customer_qty' => 'required',
            'totalprice' => 'required',
            'type' => 'required',
            'note' => 'required',
        ]);

        $purchase = new Purchase();
        $purchase->product_name = $request->product_name;
        $purchase->product_id = $request->product_id;
        $purchase->product_code = $request->product_code;
        $purchase->supplier_id = $request->supplier_id;
        $purchase->ostatus = $request->ostatus;
        $purchase->whole_price = $request->whole_price;
        $purchase->color_id = $request->colorid;
        $purchase->attribute_size = $request->attribute_size;
        $purchase->customer_qty = $request->customer_qty;
        $purchase->productprice = $request->productprice;
        $purchase->totalprice = $request->totalprice;
        $purchase->type = $request->type;
        $purchase->note = $request->note;

        // $expensedata = json_decode(json_encode($purchase),true);
        // echo "<pre>";print_r($expensedata);
        $purchase->save();

        $notification=array(
            'messege'=>'Purchase Insert successfully!',
            'alert-type'=>'success'
             );
           return Redirect()->route('purchase.all')->with($notification);
    }


    public function allview(){

        // $purchase = DB::table('purchases')
        // ->join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
        // ->join('products', 'purchases.product_id', '=', 'products.id')
        // ->select('purchases.*', 'suppliers.*', 'products.*')
        // ->get();

        $purchase = Purchase::with(['product','supplier','color'])->get();
        
        
        $productdata = json_decode(json_encode($purchase),true);
        // echo "<pre>";print_r($productdata);
        return view('purchase.index', compact('purchase'));
    }


    public function Purchaseallpage($id){

        
        $ids =  Crypt::decrypt($id);
        $purchase = Purchase::with(['product','supplier'])->findOrFail($ids);
        // $productdata = json_decode(json_encode($purchase),true);
        // echo "<pre>";print_r($productdata);
        return view('purchase.view', compact('purchase'));
    }

    public function Purchaseupdate($id,$productid){

        
        $ids =  Crypt::decrypt($id);
        $productids =  Crypt::decrypt($productid);
        $supplier = Supplier::all();
        $productids =  Crypt::decrypt($productid);
        $color = Color::where('product_id',$productids)->get();
        $product = Attribute::all(); 
        $purchase = Purchase::with(['product','supplier','color'])->findOrFail($ids);
        // $productdata = json_decode(json_encode($purchase),true);
        // echo "<pre>";print_r($productdata);
        return view('purchase.update', compact('purchase','supplier','product','color'));
    }


    public function Purchaseupdatestore(Request $request , $id, $productid){
        $validatedData = $request->validate([
            'supplier_id' => 'required',
            'ostatus' => 'required',
            'colorid' => 'required',
            'customer_qty' => 'required',
            'totalprice' => 'required',
            'type' => 'required',
            'note' => 'required',
        ]);
        $ids =  Crypt::decrypt($id);
        $productids =  Crypt::decrypt($productid);
        $purchase =  Purchase::findOrFail($ids);
        $purchase->product_name = $request->product_name;
        $purchase->product_id = $productids;
        $purchase->product_code = $request->product_code;
        $purchase->supplier_id = $request->supplier_id;
        $purchase->ostatus = $request->ostatus;
        $purchase->whole_price = $request->whole_price;
        $purchase->color_id = $request->colorid;
        $purchase->attribute_size = $request->attribute_size;
        $purchase->customer_qty = $request->customer_qty;
        $purchase->productprice = $request->productprice;
        $purchase->totalprice = $request->totalprice;
        $purchase->type = $request->type;
        $purchase->note = $request->note;

        // $expensedata = json_decode(json_encode($purchase),true);
        // echo "<pre>";print_r($expensedata);
        $purchase->save();

        $notification=array(
            'messege'=>'Purchase Update successfully!',
            'alert-type'=>'success'
             );
        if( $purchase->ostatus == 3){
            return Redirect()->route('purchase.return')->with($notification);
         }else{
            return Redirect()->route('purchase.all')->with($notification);
         }
    }


     
    public function return(){

        // $purchase = DB::table('purchases')
        // ->join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
        // ->join('products', 'purchases.product_id', '=', 'products.id')
        // ->select('purchases.*', 'suppliers.*', 'products.*')
        // ->get();

        $purchase = Purchase::with(['product','supplier'])->get();
        
        
        $productdata = json_decode(json_encode($purchase),true);
        // echo "<pre>";print_r($productdata);
        return view('purchase.return', compact('purchase'));
    }



    public function Purchasedelete(Request $request ,$id){

        $ids =  Crypt::decrypt($id);
        $expense = Purchase::findOrFail($ids)->delete();
        $notification=array(
            'messege'=>'Delete  successfully!',
            'alert-type'=>'success'
             );
           return Redirect()->route('purchase.all')->with($notification);
    }


}
