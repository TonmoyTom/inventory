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
                      <th>Product Name</th>
                      <th>Product code</th>
                      <th>Category</th>
                      <th>Whole Price</th>
                      <th>Retail Price</th>
                      <th>Status</th>
                      <th class="text-center">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @php $count=0;
  
                  
                  @endphp
                  @foreach($product as $products)
                  @php $count+=1 @endphp
                  <tr>
                      <td>{{$count}}</td>
                      <td><img style="width: 50px; height: 50px; border-radius:0px;" width="40px" width="40px" src="{{asset('/storage/product/'.$products->product_image_one)}}"></td>
                      <td>{{$products->product_name}}</td>
                      <td>{{$products->product_code}}</td>
                      <td>{{$products->category->category_name}}</td>
                      <td>{{$products->whole_price}}</td>
                      <td>{{$products->retail_price}}</td>
                      <td>
                        @if($products->status == 1)
                        <a href="javascript:void(0)" class=" updateProductstatus" id="product-{{$products->id }}"
                           section_id ="{{$products->id}}" >Active</a>
                        @else
                        <a  href="javascript:void(0)" class=" updateProductstatus" id="product-{{$products->id }}"
                          section_id ={{$products->id}}">Deactive</a>
                        @endif
                      </td>
                      
                      <td>
                        <div class="btn-group">
                          <a href="{{ route('productattribute',['id' => Crypt::encrypt($products->id)])}}" class="btn btn-warning btn-icon-text ">Attribute
                            <i class="fas fa-pencil-alt btn-icon-append"></i>   
                          </a>
                          <a href="{{ route('productview',['id' => Crypt::encrypt($products->id)])}}" class="btn btn-primary btn-icon-text">View
                            <i class="fas fa-pencil-alt btn-icon-append"></i>   
                          </a>
                          <a href="{{ route('productupdatepage',['id' => Crypt::encrypt($products->id)])}}" class="btn btn-dark btn-icon-text">Edit
                            <i class="fas fa-pencil-alt btn-icon-append"></i>   
                          </a>
                            <form action="{{ route('product.delete', ['id' => Crypt::encrypt($products->id)]) }}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" id="delete" data-name="{{ $products->name }}" class="btn btn-danger btn-icon-text right delete-confirm"> 
                                  <i class="fas fa-trash-alt btn-icon-prepend"></i>
                                   Delete
                                </button>   
                            </form>
                        </div> 
                    </td>
                  </tr>
                 
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