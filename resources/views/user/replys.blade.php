@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
         <!-- Start Model --> 
         <div class="row justify-content-center">
        <div class="col-md-8  grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Here all the product Upadate categories .</h4>
                        <h5 class="modal-title" >Upadte Category </h5>
                      </div>
                      <div class="modal-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{url('replymessagestore')}}" method="POST" >
                            @csrf
                            <input type="text" name="user_id"  value="{{Auth::id()}}">
                            <input type="text" name="messager_id" value="{{$replynewmessage->messager_id}}">
                            <input type="text" name="reply_id" value="{{Auth::id()}}">
                            <input type="text" name="name" value="{{$replynewmessage->name}}">
                          <div class="form-group">
                              {{-- <input type="hidden" value="{{$categories->id}}"> --}}
                            <label for="recipient-name" class="col-form-label">User</label>
                            <input type="email" class="form-control" name="email" placeholder="User Name" 
                            value="{{$replynewmessage->email}}">
                          </div>
                        <div>
                           <label for="recipient-name" class="col-form-label">Message</label>
                            <textarea name="message" cols="86" rows ="20" style="border-color: aqua;"></textarea> 
                        </div>
                      
                        
                      </div>
                      <div class="modal-footer">
                        <button type="submit" name="submit" class="btn btn-success">Submit</button>
                  
                      </div>
                    </form>
                    </div>
                  </div>
                </div>
    </div>
    

@endsection