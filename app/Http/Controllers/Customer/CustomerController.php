<?php

namespace App\Http\Controllers\Customer;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    } 


    public function index(){
        return view('Customer.addcustomer');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'address' => 'required',
        ]);

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->mobile = $request->mobile;
        $customer->tax = $request->tax;
        $customer->address = $request->address;
        $customer->save();

        $notification=array(
            'messege'=>'Customer Insert successfully!',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
    }

    public function view(){
        $customer = Customer::orderBy('id', 'DESC')->get();
        return view('Customer.index', compact('customer'));
    }

    public function customerupdatepage($id){

        $ids =  Crypt::decrypt($id);
        
        $customer = Customer::findOrFail($ids);
        return view('Customer.editcustomer', compact('customer'));
    }

    public function customerupdatestore(Request $request,$id){
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'address' => 'required',
        ]);

        $ids =  Crypt::decrypt($id);
        $customer = Customer::findOrFail($ids);
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->mobile = $request->mobile;
        $customer->tax = $request->tax;
        $customer->address = $request->address;
        $update = $customer->save();

        if($update){
            $notification=array(
                'messege'=>'Customer Update successfully!',
                'alert-type'=>'success'
                 );
               return Redirect()->route('customer.view')->with($notification);
        }else{
            $notification=array(
                'messege'=>'Customer Not Update successfully!',
                'alert-type'=>'danger'
                 );
               return Redirect()->back()->with($notification);
        }
    }

    public function customerdelete(Request $request ,$id){

        $ids =  Crypt::decrypt($id);
        $expense = Customer::findOrFail($ids)->delete();
        $notification=array(
            'messege'=>'Delete  successfully!',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
    }
}
