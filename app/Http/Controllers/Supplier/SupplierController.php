<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 


    public function index(){
        return view('supplier.addsupplier');
    }




    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'blance' => 'required',
            'address' => 'required',
        ]);

        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->mobile = $request->mobile;
        $supplier->tax = $request->tax;
        $supplier->blance = $request->blance;
        $supplier->address = $request->address;
        $supplier->save();

        $notification=array(
            'messege'=>'Supplier Insert successfully!',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
    }


    public function view(){
        $supplier = Supplier::orderBy('id', 'DESC')->get();
        return view('supplier.index', compact('supplier'));
    }


    public function supplierupdatepage($id){

        $ids =  Crypt::decrypt($id);
        
        $supplier = Supplier::findOrFail($ids);
        return view('supplier.editsupplier', compact('supplier'));
    }

    
    public function supplierupdatestore(Request $request,$id){
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'blance' => 'required',
            'address' => 'required',
        ]);

        $ids =  Crypt::decrypt($id);
        $supplier = Supplier::findOrFail($ids);
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->mobile = $request->mobile;
        $supplier->tax = $request->tax;
        $supplier->blance = $request->blance;
        $supplier->address = $request->address;
        $update = $supplier->save();

        if($update){
            $notification=array(
                'messege'=>'Supplier Update successfully!',
                'alert-type'=>'success'
                 );
               return Redirect()->route('supplier.view')->with($notification);
        }else{
            $notification=array(
                'messege'=>'Supplier Not Update successfully!',
                'alert-type'=>'danger'
                 );
               return Redirect()->back()->with($notification);
        }
    }

    public function supplierdelete(Request $request ,$id){

        $ids =  Crypt::decrypt($id);
        $expense = Supplier::findOrFail($ids)->delete();
        $notification=array(
            'messege'=>'Delete  successfully!',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
    }


    

}
