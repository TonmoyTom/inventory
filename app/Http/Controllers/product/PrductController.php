<?php

namespace App\Http\Controllers\product;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PrductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    } 
    
    public function index(){
        $categoris = Category::all();
        return view('product.index',compact('categoris'));
    }

    public function productstore(Request $request){

        $validatedData = $request->validate([
            'product_name' => 'required|regex:/^[\pL\s-]+$/u',
            'product_code' => 'required|regex:/^[\w-]*$/',
            'category_id' => 'required',
            'product_image_one' => 'required',
            'product_price' => 'required',
            'retail_price' => 'required',
            'whole_price' => 'required',
            'message' => 'required',
        ]); 

        $products = new Product();

        if ($files = $request->file('product_image_one')) {
            // Define upload path
            $destinationPath = public_path('/storage/product/'); // upload path
         // Upload Orginal Image           
            $productimageone = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $productimageone);
            // $insert['image'] = "$profileImage";
         // Save In Database
         }

         if ($filestwo = $request->file('product_image_two')) {
            // Define upload path
            $destinationPathtwo = public_path('/storage/product/'); // upload path
         // Upload Orginal Image           
            $productimagetwo = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $filestwo->move($destinationPathtwo, $productimagetwo);
            // $insert['image'] = "$profileImage";
         // Save In Database
         }




        $products->product_name = $request->product_name;
        $products->product_code = $request->product_code;
        $products->category_id = $request->category_id;
        $products->barcode = $request->barcode;
        $products->product_price = $request->product_price;
        $products->retail_price = $request->retail_price;
        $products->whole_price = $request->whole_price;
        $products->message = $request->message;
        $products->product_image_one = $productimageone;

        if(!empty($request->file('product_image_two'))){
            $products->product_image_two = $productimagetwo;
        }else{
            $products->product_image_two = "";
        }

        $products->save();
       
        

        $notification=array(
            'messege'=>'Product Insert successfully!',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);

    }


    public function data(){

        $product = Product::with('Category')->orderBy('id', 'DESC')->get();
        return view('product.data',compact('product'));
    }


    public function productstatus(Request $request){
        $data = $request->all();
        // echo "<pre>";print_r($data);
        if($data['status'] == "Active"){
            $status = 0;
        }else{
            $status = 1;
        }

        Product::where('id',$data['section_id'])->update(['status'=>$status]);
       return response()->json(['status'=>$status,'section_id'=>$data['section_id']]);

    }

    public function productupdatepage($id){

        $ids =  Crypt::decrypt($id);
        $categoris = Category::all();
        $product = Product::findOrFail($ids);
        return view('product.updateproduct', compact('product','categoris'));
    }




    public function productupdatestore(Request $request,$id){

        $validatedData = $request->validate([
            'product_name' => 'required|regex:/^[\pL\s-]+$/u',
            'product_code' => 'required|regex:/^[\w-]*$/',
            'category_id' => 'required',
            // 'product_image_one' => 'required',
            'product_price' => 'required',
            'retail_price' => 'required',
            'whole_price' => 'required',
            'message' => 'required',
        ]); 
        $ids =  Crypt::decrypt($id);
        $products = Product::findOrFail($ids);

      

        




        $products->product_name = $request->product_name;
        $products->product_code = $request->product_code;
        $products->category_id = $request->category_id;
        $products->barcode = $request->barcode;
        $products->product_price = $request->product_price;
        $products->retail_price = $request->retail_price;
        $products->whole_price = $request->whole_price;
        $products->message = $request->message;
       
        if(empty($request->file('product_image_one'))){
            $update = $products->save();
        }else{

            if ($files = $request->file('product_image_one')) {
                // Define upload path
                $destinationPath = public_path('/storage/product/'); // upload path
             // Upload Orginal Image           
                $productimageone = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $productimageone);
                // $insert['image'] = "$profileImage";
             // Save In Database
             }
            $products->product_image_one = $productimageone;
            $update = $products->save();
        }
        if(empty($request->file('product_image_two'))){
            $update = $products->save();
        }else{

            if ($filestwo = $request->file('product_image_two')) {
                // Define upload path
                $destinationPathtwo = public_path('/storage/product/'); // upload path
             // Upload Orginal Image           
                $productimagetwo = date('YmdHis') . "." . $filestwo->getClientOriginalExtension();
                $filestwo->move($destinationPathtwo, $productimagetwo);
                // $insert['image'] = "$profileImage";
             // Save In Database
             }
            $products->product_image_two = $productimagetwo;
            $update = $products->save();
        }

        $data = $request->all();
        print_r($data);
        // $products->save();
       
        

        $notification=array(
            'messege'=>'Product Insert successfully!',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);

    }


    public function productview($id){

        $ids =  Crypt::decrypt($id);
        $product = Product::findOrFail($ids);
        return view('product.productview', compact('product'));
    }

    public function productdelete(Request $request ,$id){

        $ids =  Crypt::decrypt($id);
        $product = Product::findOrFail($ids)->delete();
        return back();
    }





}
