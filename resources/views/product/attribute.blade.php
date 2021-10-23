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
                    
                      <th>Image One</th>
                      @if ($product->product_image_two == NULL)
                      @else
                      <th>Image Two</th>
                      @endif
                      <th>Product Name</th>
                      <th>Product code</th>
                      <th>Category</th>
                      <th>Quantity</th>
                      <th>Whole Price</th>
                      <th>Retail Price</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                      <td><img style="width: 50px; height: 50px; border-radius:0px;" width="40px" width="40px" src="{{asset('/storage/product/'.$product->product_image_one)}}"></td>
                      @if ($product->product_image_two == NULL)
                      @else
                      <td><img style="width: 50px; height: 50px; border-radius:0px;" width="40px" width="40px" src="{{asset('/storage/product/'.$product->product_image_two)}}"></td>
                      @endif
                      <td>{{$product->product_name}}</td>
                      <td>{{$product->product_code}}</td>
                      <td>{{$product->category->category_name}}</td>
                      <td>{{$attributestock}}</td>
                      <td>{{$product->whole_price}}</td>
                      <td>{{$product->retail_price}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div>
        </div>
      </div>

    </div>
  </div>
  <div class="page-header">
    <h3 class="page-title">
     Add Color
    </h3>
    
  </div>
        @if(Session::has('error_message'))
            <div class="alert alert-fill-warning" role="alert">
              <i class="fa fa-exclamation-triangle"></i>
                  {{Session::get('error_message')}}
            </div>
        @endif
  <div class="row">
    
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card-body">
          <form method="POST" action="{{ route('productattributecolorstore',['id' => Crypt::encrypt($product->id)])}}" id="attribute" class="attribute">
            @csrf
            <div class="field_wrappercolor">
                <div>
                    <input type="text" name="color[]" value="" id="size" name="color[]" placeholder="Color"/>
                    <a href="javascript:void(0);" class="addcolor_button" title="Add field"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="btn1" style="margin-top: 50px;">
              <button type="submit" name="submit" class="btn btn-success">Submit</button>
            </div>
            
          </form>
        </div>
      </div>
  <div class="page-header">
    <h3 class="page-title">
     Add Attribute
    <div style="margin-top:10px; ">
      <h6><i>If you Are Color Not Set then you are Not Select Attribute</i></h6>
    </div>
    </h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
       
      </ol>
    </nav>
  </div>
        @if(Session::has('error_message'))
            <div class="alert alert-fill-warning" role="alert">
              <i class="fa fa-exclamation-triangle"></i>
                  {{Session::get('error_message')}}
            </div>
        @endif
  <div class="row">

      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card-body">
          <form method="POST" action="{{ route('productattributestore',['id' => Crypt::encrypt($product->id)])}}" id="attribute" class="attribute">
            @csrf
            <div class="field_wrapper">
                <div>
                    <input type="text" name="size[]" value="" id="size" name="size[]" placeholder="Size"/>
                      <select style="width: 200px; height: 27px; " id= "stockcolor"   name="colorid[]">
                        <option>Color Select</option>
                      @foreach ($color as $item)
                         <option value="{{$item->id}}">{{$item->colorname}}</option>
                      @endforeach
                       
                      </select>
                    <input type="number" name="price[]" value="" id="price" name="price[]" required placeholder="Price"/>
                    <input type="number" name="stock[]" value="" id="stock" name="stock[]" required placeholder="Stock"/>
                    <input type="text" name="sku[]" value="" id="sku" name="sku[]" required placeholder="SKU"/>
                    <a href="javascript:void(0);" class="add_button" title="Add field"><i class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="btn1" style="margin-top: 50px;">
              <button type="submit" name="submit" class="btn btn-success">Submit</button>
            </div>
            
          </form>
        </div>
      </div>

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
                        <th>sku</th>
                        <th>size</th>
                        <th>Color</th>
                        <th>price</th>
                        <th>stock</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <form method="POST" action="{{ route('productattributeupdate',['id' => Crypt::encrypt($product->id)])}}" id="editattribute" class="editattribute">
                    @csrf
                    @foreach($product['attributes'] as $attribute)
                    <tr>
                        <input style="display: none" type="text" name="attrid[]"   value="{{$attribute->id}}">
                        <td>
                          <input type="text" name="sku[]"  id="sku" name="size[]" value="{{$attribute->sku}}">
                        </td>
                        
                        @if ($attribute->size == NULL)
                        <td> <input type="text" name="size[]" id="size" name="size[]" value="Null"></td>
                        @else
                        <td>
                          <input type="text" name="size[]" id="size" name="size[]" value="{{$attribute->size}}">
                         </td>
                        @endif
                        <td>
                          <select style="width: 200px; height: 27px; " id= "color"   name="colorid[]">
                            <option>Color Select</option>
                          @foreach ($color as $item)
                             <option value="{{$item->id}} " <?php if($attribute->colorid == $item->id){
                              echo "selected";
                          } ?>>{{$item->colorname}}</option>
                          @endforeach
                          
                          </select>
                         </td>
                       
                        <td>
                          <input type="text" name="price[]"  id="price" name="price[]" value="{{$attribute->price}}">
                          </td>
                        <td>
                          <input type="text" name="stock[]"  id="stock" name="stock[]" value="{{$attribute->stock}}">
                        </td>

                        <td>
                         
                        <div class="btn-group">
                          <a href="{{ route('productattribute.delete', ['id' => Crypt::encrypt($attribute->id)]) }}" class="btn btn-danger btn-icon-text" id="delete">Delete
                            <i class="fas fa-pencil-alt btn-icon-append"></i>   
                          </a>
                            
                        </div>
                        </td>
                        
                    </tr>
                    @endforeach

                   
                  </tbody>
                </table>
                <div>
                  <h6 class="text-right" style="margin-right: 210px; font-weight: bold;">Total Stock = {{$attributestock}}</h6>
                </div>
                
              </div>
              <button type="submit" name="submit" class="btn btn-success">Update</button>
              </form>
            </div>
            <div>
          </div>
        </div>
  
      </div>
    </div>
    </
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


