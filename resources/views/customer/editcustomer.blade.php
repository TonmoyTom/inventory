@extends('layouts.app')

@section('content')



      
<div class="main-panel">
  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
    <div class="content-wrapper">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"> Supplier Information</h4>
            <form class="form-sample" method="POST" action="{{route('customerupdatestore.store',['id' => Crypt::encrypt($customer->id)])}}" >
              @csrf
              <p class="card-description">
                Supplier info
              </p>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Supplier Name </label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="name" placeholder="Customer Name" value="{{$customer->name}}" />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label"> Email</label>
                    <div class="col-sm-9">
                      <input type="email" class="form-control" name="email" placeholder="Email" value="{{$customer->email}}"/>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Mobile </label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control" name="mobile" placeholder="Mobile"  value="{{$customer->mobile}}"/>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">TAX Number </label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="tax" placeholder="TAX Number" value="{{$customer->tax}}"/>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Address </label>
                    <div class="col-sm-9">
                        <textarea  name="address" cols="49" rows ="3" style="border-color: aqua;">{{$customer->address}}"</textarea> 
                     
                    </div>
                  </div>
                </div>
              </div>
              <button type="submit" name="submit" class="btn btn-success">Submit</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>

  
@endsection