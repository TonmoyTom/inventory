<?php

namespace App\Http\Controllers\Expense;

use App\Expense;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 

    public function index(){
        return view('expense.addexpense');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        $expense = new Expense();
        $expense->title = $request->title;
        $expense->description = $request->description;
        $expense->price = $request->price;
        $expense->save();

        $notification=array(
            'messege'=>'Expense Insert successfully!',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
    }


    public function view(){
        $expense = Expense::orderBy('id', 'DESC')->get();
        return view('expense.expense', compact('expense'));
    }



    public function expenseupdatepage($id){

        $ids =  Crypt::decrypt($id);
        
        $expense = Expense::findOrFail($ids);
        return view('expense.editexpense', compact('expense'));
    }


    public function expenseupdatestore(Request $request ,$id){
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);
        
        $ids =  Crypt::decrypt($id);
        $expense = Expense::findOrFail($ids);
        $expense->title = $request->title;
        $expense->description = $request->description;
        $expense->price = $request->price;
        $update = $expense->save();
        if($update){
            $notification=array(
                'messege'=>'Expense Update successfully!',
                'alert-type'=>'success'
                 );
               return Redirect()->route('expense.view')->with($notification);
        }else{
            $notification=array(
                'messege'=>'Expense Not Update successfully!',
                'alert-type'=>'danger'
                 );
               return Redirect()->back()->with($notification);
        }


    }


    public function expensedelete(Request $request ,$id){

        $ids =  Crypt::decrypt($id);
        $expense = Expense::findOrFail($ids)->delete();
        $notification=array(
            'messege'=>'Delete  successfully!',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
    }
}
