<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::orderBy('id', 'ASC')->get();
        return view('user.user', compact('users'));
    }

    public function userstore(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'image' => 'required | mimes:jpeg,jpg,png | max:1000',
        ]);

    

          if ($files = $request->file('image')) {
            // Define upload path
            $destinationPath = public_path('/storage/image/'); // upload path
         // Upload Orginal Image           
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            // $insert['image'] = "$profileImage";
         // Save In Database
         }

        $users = new User();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password =Hash::make( $request->password);
        $users->image = $profileImage;
        $users->save();

        $notification=array(
            'messege'=>'User Insert successfully!',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
    }

    // public function profile()
    // {
    //     return view('auth.user.profile');
    // }

    public function userupdatepage($id)
    {
        $ids =  Crypt::decrypt($id);
        
        $users = User::findOrFail($ids);
        return view('user.userupdate', compact('users'));
    }

    public function userupdatestore(Request $request ,$id){

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
           
        ]);
        
        $ids =  Crypt::decrypt($id);
        $users = User::findOrFail($ids);
        $users->name = $request->name;
        $users->email = $request->email;
        
        if(!empty($request->password)){
            $users->password =Hash::make( $request->password);
            $update = $users->save();
        }else{
            $users->password =Hash::make( $request->password);
            $update = $users->save();
        }
        if(empty($request->file('image'))){
            $update = $users->save();
        }else{

            if ($files = $request->file('image')) {
                // Define upload path
                $destinationPath = public_path('/storage/image/'); // upload path
             // Upload Orginal Image           
                $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profileImage);
                // $insert['image'] = "$profileImage";
             // Save In Database
             }
            $users->image = $profileImage;
            $update = $users->save();
        }

        $update = $users->save();

        if($update){
            $notification=array(
                'messege'=>'Category Update successfully!',
                'alert-type'=>'success'
                 );
               return Redirect()->route('user')->with($notification);
        }else{
            $notification=array(
                'messege'=>'Category Not Update successfully!',
                'alert-type'=>'danger'
                 );
               return Redirect()->back()->with($notification);
        }


    }


    public function userdelete(Request $request ,$id){

        $ids =  Crypt::decrypt($id);
        $user = User::findOrFail($ids)->delete();

        if($user){
            $notification=array(
                'messege'=>'User delete successfully!',
                'alert-type'=>'danger'
                 );
               return Redirect()->route('message.data')->with($notification);
        }else{
            $notification=array(
                'messege'=>'User delete Not  successfully!',
                'alert-type'=>'success'
                 );
               return Redirect()->back()->with($notification);
        }
    }

    public function message($id){
        $ids =  Crypt::decrypt($id);
        $message= User::findOrFail($ids);
        return view('user.message', compact('message'));
    }


    public function messagestore(Request $request){

        // $validatedData = $request->validate([
        //     'subject' => 'required',
        //     'message' => 'required',
           
        // ]);

        $message = new message();
        $message->user_id = Auth::id();
        $message->messager_id = $request->messager_id;
        $message->reply_id = $request->reply_id;
        $message->name = $request->name;
        $message->email = $request->email;
        $message->subject = $request->subject;
        $message->message = $request->message;
        $insert = $message->save();

        if($insert){
            $notification=array(
                'messege'=>'Message Data successfully!',
                'alert-type'=>'danger'
                 );
               return Redirect()->route('message.data')->with($notification);
        }else{
            $notification=array(
                'messege'=>'Message Data not successfully!',
                'alert-type'=>'success'
                 );
               return Redirect()->back()->with($notification);
        }

    }

    public function messagedata(){
        
        $messagedata = message::with('user')->where('messager_id',Auth::id())->orderBy('id', 'DESC')->get();
        return view('user.messagebox', compact('messagedata'));
    }

    public function sentmessage(){
        
        $sentmessage = message::with('user')->where('user_id',Auth::id())->orderBy('id', 'DESC')->get();
        return view('user.sentbox', compact('sentmessage'));
    }

    public function replymessage($id){
        
        $replymessage =message::with('user')->where('messager_id',Auth::id())->findOrFail($id);
        return view('user.reply', compact('replymessage'));
    }


    public function replystore(Request $request){

        $validatedData = $request->validate([
            'message' => 'required',
           
        ]);
       
        $message = new message();
        $message->user_id = Auth::id();
        $message->messager_id = $request->messager_id;
        $message->reply_id =Auth::id();
        $message->name = $request->name;
        $message->email = $request->email;
        $message->message = $request->message;
        $rply = $message->save();
        if($rply){
            $notification=array(
                'messege'=>'Message Data successfully!',
                'alert-type'=>'danger'
                 );
               return Redirect()->route('user')->with($notification);
        }else{
            $notification=array(
                'messege'=>'Message Data not successfully!',
                'alert-type'=>'success'
                 );
               return Redirect()->back()->with($notification);
        }

    }


    public function messagedelete(Request $request ,$id){

        $categories = message::findOrFail($id)->delete();
        return back();
    }


    
    public function sentmessagedelete(Request $request ,$id){

        $categories = message::findOrFail($id)->delete();
        return back();
    }


    public function replyview($id){
        
        $viewmessage =message::with('user')->where('messager_id',Auth::id())->findOrFail($id);
        $updatemessage = message::where('id', $id)->update(['status' =>1]);
        
        return view('user.inboxview',compact('viewmessage','updatemessage'));
    }

    public function sentviews($id){
        
       
        $sentimgview =message::with('user')->where('user_id',Auth::id())->findOrFail($id);
        
        return view('user.sentview',compact('sentimgview'));
    }
    

    
    public function replysmessage($id){

        
        // $replymessage =message::with('user')->where('messager_id',Auth::id())->findOrFail($id);
      $replynewmessage  = message::with('user')->findOrFail($id);
        return view('user.replys', compact('replynewmessage'));
    }


    public function messageuser(){
        $users = User::orderBy('id', 'ASC')->get();
        return view('user.messageuser', compact('users'));
    }


    

}
