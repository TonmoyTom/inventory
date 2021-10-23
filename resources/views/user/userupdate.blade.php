@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
         <!-- Start Model --> 
         <div class="row justify-content-center">
        <div class="col-md-12  grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Here all the product Upadate categories .</h4>
                  <div class="modal-dialog" role="document">
                    <div class="modal-content" style="top: 0px">
                      <div class="modal-header">
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
                        <form action="{{url('userupdatestore/'.Crypt::encrypt($users->id))}}" method="POST" enctype="multipart/form-data">
                            @csrf
                          <div class="form-group">
                              {{-- <input type="hidden" value="{{$categories->id}}"> --}}
                            <label for="recipient-name" class="col-form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="User Name" value="{{$users->name}}">
                          </div>
                          <div class="form-group">
                            {{-- <input type="hidden" value="{{$categories->id}}"> --}}
                          <label for="recipient-name" class="col-form-label">Email</label>
                          <input type="email" class="form-control" name="email" placeholder="Email" value="{{$users->email}}">
                        </div>
                        <div class="form-group">
                            {{-- <input type="hidden" value="{{$categories->id}}"> --}}
                          <label for="recipient-name" class="col-form-label">Password</label>
                          <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        
                        <div class="form-group">
                            {{-- <input type="hidden" value="{{$categories->id}}"> --}}
                            <select class="form-control " name="role">
                                <option>Select Role</option>
                                   <option value="1"
                                   <?php
                                       if($users->status == 1){
                                           echo "selected";
                                       }
                                       
                                   ?>
                                   >Admin</option>
                                   <option value="2"
                                   <?php
                                   if($users->status == 2){
                                       echo "selected";
                                   }
                                   
                                   ?>
                                   >User</option>
                           </select>
                        </div>

                         <div class="form-group">
                            {{-- <input type="hidden" value="{{$categories->id}}"> --}}
                          <label for="recipient-name" class="col-form-label">Image</label>
                          <input type="file" class="form-control dropify" name="image" >
                          <a href="{{url('/storage/image/'.$users->image)}}">View Image</a>
                         
                        </div>
                        
                      </div>
                      <div class="modal-footer">
                        <button type="submit" name="submit" class="btn btn-success">Submit</button>
                        <a href="{{route('categories')}}" class="btn btn-light" >Close</a>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
    

@endsection