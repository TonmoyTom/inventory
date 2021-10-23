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
            <h4 class="card-title"> Expense </h4>
            <form class="form-sample" method="POST" action="{{route('expense.store')}}" >
              @csrf
              <p class="card-description">
                Add Expense 
              </p>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Title </label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="title" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Description </label>
                    <div class="col-sm-9">
                        <textarea id="summernoteExample" name="description"  style="border-color: aqua;"></textarea> 
                    </div>
                  </div>
                </div>            
              </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Product Price </label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" name="price" />
                </div>
              </div>
            </div>            
          </div>
             <button type="submit" name="submit" class="btn btn-success">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>

  
@endsection