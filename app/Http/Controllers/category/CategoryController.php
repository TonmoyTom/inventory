<?php

namespace App\Http\Controllers\category;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 


    public function index(){
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('category.category', compact('categories'));
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'category_name' => 'required',
        ]);

        $categories = new Category();
        $categories->category_name = $request->category_name;
        $categories->save();

        $notification=array(
            'messege'=>'Category Insert successfully!',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);



    }

    public function categorystatus(Request $request){
        $data = $request->all();
        // echo "<pre>";print_r($data);
        if($data['status'] == "Active"){
            $status = 0;
        }else{
            $status = 1;
        }

        Category::where('id',$data['section_id'])->update(['status'=>$status]);
       return response()->json(['status'=>$status,'section_id'=>$data['section_id']]);

    }

    public function categoryupdatepage($id){

        $ids =  Crypt::decrypt($id);
        
        $categories = Category::findOrFail($ids);
        return view('category.updatecategory', compact('categories'));
    }

    public function categoryupdatestore(Request $request ,$id){
        $validatedData = $request->validate([
            'category_name' => 'required',
        ]);
        
        $ids =  Crypt::decrypt($id);
        $categories = Category::findOrFail($ids);
        $categories->category_name = $request->category_name;
        $update = $categories->save();
        if($update){
            $notification=array(
                'messege'=>'Category Update successfully!',
                'alert-type'=>'success'
                 );
               return Redirect()->route('categories')->with($notification);
        }else{
            $notification=array(
                'messege'=>'Category Not Update successfully!',
                'alert-type'=>'danger'
                 );
               return Redirect()->back()->with($notification);
        }


    }

    public function categorydelete(Request $request ,$id){

        $ids =  Crypt::decrypt($id);
        $categories = Category::findOrFail($ids)->delete();
        return back();
    }

    
}
