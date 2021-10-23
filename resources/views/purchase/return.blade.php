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
                  @foreach($purchase as $purchases)
                  @php $count+=1;
                  $due =  $purchases->productprice - $purchases->totalprice;
                  
                  @endphp

                  @if($purchases->ostatus == 3)

                 
                  <tr>
                    <td>{{$count}}</td>
                    <td><img style="width: 50px; height: 50px; border-radius:0px;" width="40px" width="40px" src="{{asset('/storage/product/'.$purchases->product->product_image_one)}}"></td>
                    <td>{{$purchases->product_code}}
                    <td>{{$purchases->product_name}}
                      <div>
                       @if($purchases->ostatus == "0")   
                          <span style="border-radius: 10px; font-size: 09px; padding:5px;" class="badge badge-success">Final</span>
                      @elseif($purchases->ostatus == "1")
                          <span style="border-radius: 10px; font-size: 09px; padding:5px;" class="badge badge-warning">Pending</span>
                           @elseif($purchases->ostatus == "2")
                          <span style="border-radius: 10px; font-size: 09px; padding:5px;" class="badge badge-info">Orderd</span>
                      @endif    
                  </div>
                  </td>
                    
                    <td>{{$purchases->supplier->name}}</td>
                    <td>{{$purchases->customer_qty}}</td>  
                    <td>{{$purchases->color->colorname}}</td>  
                    <td>{{$purchases->attribute_size ? : "Null"  }}</td>  
                    <td>{{$purchases->productprice}}</td>
                    <td>{{$purchases->totalprice}}</td>
                    <td>{{$due}}</td>
                      
                      
                      
                      <td>
                        <div class="btn-group">
                          <a href="{{ route('Purchaseallpage', ['id' => Crypt::encrypt($purchases->id)]) }}" class="btn btn-primary btn-icon-text">View
                            <i class="fas fa-pencil-alt btn-icon-append"></i>   
                          </a>
                          <a href="{{ url('/purchaseupdate/'.Crypt::encrypt($purchases->id).'/product/'.Crypt::encrypt($purchases->product_id))}}" class="btn btn-dark btn-icon-text">Edit
                            <i class="fas fa-pencil-alt btn-icon-append"></i>   
                          </a>
                            <form action="{{ route('Purchaseupdate.delete', ['id' => Crypt::encrypt($purchases->id)]) }}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" id="delete" data-name="" class="btn btn-danger btn-icon-text right delete-confirm"> 
                                  <i class="fas fa-trash-alt btn-icon-prepend"></i>
                                   Delete
                                </button>   
                            </form>
                        </div> 
                    </td>
                  </tr>
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