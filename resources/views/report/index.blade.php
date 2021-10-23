@extends('layouts.app')

@section('content')

<div class="main-panel">
  <div class="content-wrapper">
    <div class="card">
        <div class="card-body">
          <h4 class="card-title"> Please Enter Valid Information</h4>
          <form class="form-sample" id="form" method="POST"  >
            @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">From Date </label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" name="fromdate" id="fromdate" />
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">To Date </label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" name="todate" id="todate"  />
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Supplier Name</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="supplier_id" id="supplier_id">
                        <option>Select</option>
                      @foreach ($supplier as $item)
                      <option value="{{$item->id}}">{{$item->name}}</option>
                      @endforeach
                       
                      </select>
                    </div>
                  </div>
                </div>  
              </div>
           <button type="submit" name="submit" id="purchasesubmit" class="btn btn-success">Submit</button>
         <a href="" class="btn btn-danger btn-icon-text">Close<a>
          </form>
        </div>
      </div><br>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="page-header">
                <h3 class="page-title" style="margin-left: 20px; margin-top:20px;">
                  Report Table
                </h3>
              </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="order-listing" class="table">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Purchase Date</th>
                    <th>Supplier Name</th>
                    <th>Invoice Total</th>
                    <th>Paid Payment</th>
                    <th>Due Paid Payment</th>
                    
                    
                  </tr>
                </thead>
                <tbody>
          
                    @include('report.append_purchasereport')
 
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- content-wrapper ends -->
  <!-- partial:../../partials/_footer.html -->
  <footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
      <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2018 <a href="https://www.urbanui.com/" target="_blank">Urbanui</a>. All rights reserved.</span>
      <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="far fa-heart text-danger"></i></span>
    </div>
  </footer>
  <!-- partial -->
</div>



@endsection