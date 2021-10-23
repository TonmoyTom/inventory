@extends('layouts.app')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        Product Table
      </h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Product Table</a></li>
        </ol>
      </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <table id="order-listing" class="table">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Image</th>
                      <th>Product code</th>
                      <th>Product Name</th>
                      <th>Customer Name</th>
                      <th>Quantity</th>
                      <th>Color</th>
                      <th>Size</th>
                      <th>Total</th>
                      <th>PaidPayment</th>
                      <th>Due</th>
                      <th class="text-center">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @php $count=0; @endphp
                  @foreach($sale as $sales)
                  @php $count+=1;
                  $due =  $sales->productprice - $sales->totalprice;
                  
                  @endphp

                  @if($sales->ostatus == 3)

                  <td>{{$count}}</td>
                  <td><img style="width: 50px; height: 50px; border-radius:0px;" width="40px" width="40px" src="{{asset('/storage/product/'.$sales->product->product_image_one)}}"></td>
                  <td>{{$sales->product_code}}
                  <td>{{$sales->product_name}}
                    <div>
                      @if($sales->ostatus == "0")   
                      <span style="border-radius: 10px; font-size: 09px; padding:5px;" class="badge badge-success">Received</span>
                  @elseif($sales->ostatus == "1")
                      <span style="border-radius: 10px; font-size: 09px; padding:5px;" class="badge badge-warning">Pending</span>
                  @elseif($sales->ostatus == "2")
                      <span style="border-radius: 10px; font-size: 09px; padding:5px;" class="badge badge-info">Ordered</span>
                      @elseif($sales->ostatus == "3")
                      <span style="border-radius: 10px; font-size: 09px; padding:5px;" class="badge badge-danger">Return Order</span>
                  @endif  
                </div>
                </td>
                  <td>{{$sales->customer->name}}</td>
                  <td>{{$sales->customer_qty}}</td>  
                  <td>{{$sales->color->colorname}}</td>  
                  <td>{{$sales->attribute_size}}</td>  
                  <td>{{$sales->productprice}}</td>
                  <td>{{$sales->totalprice}}</td>
                  <td>{{$due}}</td>
                  {{-- <td>{{$sales->created_at->format('j M Y ')}}</td> --}}
                  
                 
                 
                  <td>
                    <div class="btn-group">
                      <a href="{{ route('salesallpage', ['id' => Crypt::encrypt($sales->id)]) }}" class="btn btn-primary btn-icon-text">View
                        <i class="fas fa-pencil-alt btn-icon-append"></i>   
                      </a>
                      <a href="{{ url('/salesupdate/'.Crypt::encrypt($sales->id).'/product/'.Crypt::encrypt($sales->product_id))}}" class="btn btn-dark btn-icon-text">Edit
                        <i class="fas fa-pencil-alt btn-icon-append"></i>   
                      </a>
                        <form action="{{ route('salesupdate.delete', ['id' => Crypt::encrypt($sales->id)]) }}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" id="delete" data-name="" class="btn btn-danger btn-icon-text right delete-confirm"> 
                              <i class="fas fa-trash-alt btn-icon-prepend"></i>
                               Delete
                            </button>   
                        </form>
                    </div> 
                </td>
                  @else
                    @endif
                  @endforeach
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