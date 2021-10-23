<?php

namespace App\Http\Controllers\Attribute;

use App\Attribute;
use App\Color;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class AttributeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function productattribute($id)
    {

        $ids =  Crypt::decrypt($id);
        $product = Product::with('attributes', 'color')->findOrFail($ids);
        $attributestock =  Attribute::where('product_id', $ids)->sum('stock');
        $attribute =  Attribute::where('product_id', $ids)->first();
        $color =  Color::where('product_id', $ids)->get();
        // $productdata = json_decode(json_encode($product),true);
        // echo "<pre>";print_r($productdata);
        return view('product.attribute', compact('product', 'attributestock', 'color', 'attribute'));
    }


    public function productattributestore(Request $request, $id)
    {

        if ($request->isMethod('post')) {

            $ids =  Crypt::decrypt($id);
            // $product = Product::findOrFail($ids);



            $data = $request->all();
            // echo "<pre>";print_r($data);
            foreach ($data['sku'] as $key => $value) {
                if (!empty($value)) {
                    // $attributesku =  DB::table('attributes')->where(['sku'=> $value])->count('sku');
                    $attributesku =  Attribute::where('sku', $value)->count();
                    if ($attributesku > 0) {
                        $message  = "SKU Already Exits. Please add Another SKU";
                        $request->session()->flash('error_message', $message);
                        return Redirect()->back();
                    }


                    if ($data['size'][$key] == null) {
                        $attribute = new Attribute;
                        $attribute->product_id = $ids;
                        $attribute->price = $data['price'][$key];
                        $attribute->size = $data['size'][$key];
                        $attribute->colorid = $data['colorid'][$key];
                        $attribute->stock = $data['stock'][$key];
                        $attribute->sku = $value;
                        //  echo "<pre>";print_r($attribute);
                        $attribute->save();
                    } else {
                        $attributesize =  Attribute::where(['product_id' => $ids, 'colorid' => $data['colorid'][$key], 'size' => $data['size'][$key]])->count();

                        // dd($attributesize);
                        if ($attributesize > 0) {
                            $message  = "Size Already Exits. Please add Another Size";
                            $request->session()->flash('error_message', $message);
                            return Redirect()->back();
                        }
                    }



                    $attribute = new Attribute;
                    $attribute->product_id = $ids;
                    $attribute->price = $data['price'][$key];
                    $attribute->size = $data['size'][$key];
                    $attribute->colorid = $data['colorid'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->sku = $value;
                    //  echo "<pre>";print_r($attribute);
                    $attribute->save();
                }
            }
        }

        $notification = array(
            'messege' => 'Product Insert successfully!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function productattributecolorstore(Request $request, $id)
    {

        if ($request->isMethod('post')) {

            $ids =  Crypt::decrypt($id);
            // $product = Product::findOrFail($ids);



            $data = $request->all();
            // echo "<pre>";print_r($data);
            foreach ($data['color'] as $key => $value) {
                if (!empty($value)) {
                    // $attributesku =  DB::table('attributes')->where(['color'=> $value])->count('color');
                    $attributesku =  Color::where(['product_id' => $ids, 'colorname' => $data['color'][$key]])->count();
                    if ($attributesku > 0) {
                        $message  = "Color Already Exits. Please add Another COlor";
                        $request->session()->flash('error_message', $message);
                        return Redirect()->back();
                    }

                    // $attributesize =  Attribute::where(['product_id'=> $ids,'size' =>$data['size'][$key]])->count();
                    // // dd($attributesize);
                    // if($attributesize > 0){
                    //     $message  = "Size Already Exits. Please add Another Size";
                    //     $request->session()->flash('error_message', $message);
                    //     return Redirect()->back();
                }



                $attribute = new Color();
                $attribute->product_id = $ids;
                $attribute->colorname = $value;
                //  echo "<pre>";print_r($attribute);
                $attribute->save();
            }
        }


        $notification = array(
            'messege' => 'Product Insert successfully!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }




    public function productattributeupdate(Request $request, $id)
    {

        if ($request->isMethod('post')) {

            $ids =  Crypt::decrypt($id);
            // $product = Product::findOrFail($ids);



            $data = $request->all();
            //echo "<pre>";print_r($data);
            foreach ($data['attrid'] as $key => $value) {
                if (!empty($value)) {
                    $attribute = Attribute::where(["id" => $data['attrid'][$key]])->update(['sku' => $data['sku'][$key], 'size' => $data['size'][$key], 'colorid' => $data['colorid'][$key], 'price' => $data['price'][$key], 'stock' => $data['stock'][$key]]);
                }
            }
        }
        $notification = array(
            'messege' => 'Attribute update successfully!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function productattributedelete($id)
    {

        $ids =  Crypt::decrypt($id);
        $attribute = Attribute::findOrFail($ids)->delete();
        $notification = array(
            'messege' => 'Attribute Delete successfully!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
}
