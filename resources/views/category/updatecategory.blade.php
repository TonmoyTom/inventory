@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
         <!-- Start Model --> 
         <div class="row justify-content-center">
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Here all the product Upadate categories .</h4>
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
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
                        <form action="{{url('categoryupdatestore/'.Crypt::encrypt($categories->id))}}" method="POST">
                            @csrf
                          <div class="form-group">
                              {{-- <input type="hidden" value="{{$categories->id}}"> --}}
                            <label for="recipient-name" class="col-form-label">Category</label>
                            <input type="text" class="form-control" name="category_name" placeholder="Category Name" value="{{$categories->category_name}}">
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
    </div>

@endsection