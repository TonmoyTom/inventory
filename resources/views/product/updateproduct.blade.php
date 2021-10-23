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
            <h4 class="card-title"> Product Information</h4>
            <form class="form-sample" method="POST" action="{{route('productupdate.store',['id' => Crypt::encrypt($product->id)])}}" enctype="multipart/form-data">
              @csrf
              <p class="card-description">
                Product info
              </p>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Product Name </label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="product_name" value="{{$product->product_name}}" />
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Product Code </label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="product_code" value="{{$product->product_code}}"/>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Category</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="category_id" id="category_id">
                      @foreach ($categoris as $item)
                      <option  value="{{$item->id}}" <?php if($product->category_id == $item->id){
                          echo "selected";
                      } ?>>{{$item->category_name}}</option>
                      @endforeach
                       
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">BarCodes </label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="barcode" value="{{$product->barcode}}"/>
                    </div>
                  </div>
              </div>
              </div>
              <hr>
              <h4 class="card-title">Imgae</h4>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Product Image</label>
                    <div class="col-sm-9">
                      <input type="file" class="form-control dropify" name="product_image_one" >
                    </div>
                  </div>
              </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <div class="col-sm-9">
                      <input type="file" class="form-control dropify" name="product_image_two" >
                    </div>
                  </div>
              </div>
              </div>
              <h4 class="card-title">Old Imgae</h4>
              <div class="row">
                  @if(!empty($product->product_image_one  && $product->product_image_two))
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Product Image</label>
                    <div class="col-sm-6">
                        <img style="width: 100px; height: 100px; border-radius:0px;" width="40px" width="40px" src="{{asset('/storage/product/'.$product->product_image_one)}}">
                    </div>
                  </div>
              </div>
                <div class="col-md-4">
                  <div class="form-group row">
                    <div class="col-sm-9">
                        <img style="width: 100px; height: 100px; border-radius:0px;" width="40px" width="40px" src="{{asset('/storage/product/'.$product->product_image_two)}}">
                    </div>
                  </div>
              </div>
              @else
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Product Image</label>
                  <div class="col-sm-9">
                      <img style="width: 100px; height: 100px; border-radius:0px;" width="40px" width="40px" src="{{asset('/storage/product/'.$product->product_image_one)}}">
                  </div>
                </div>
            </div>
            @endif
              </div>

            <hr>
            <h4 class="card-title">Units</h4>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Product Quantity  </label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control" name="qty" value="{{$product->qty}}"/>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Minimum Quantity </label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control" value="{{$product->min_qty}}" name="min_qty" />
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <h4 class="card-title">Price</h4>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Product Price </label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control" name="product_price" value="{{$product->product_price}}" />
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Whole Price </label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control"name="whole_price" value="{{$product->whole_price}}"  />
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label"> Retail Price</label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control"  name="retail_price" value="{{$product->retail_price}}" />
                  </div>
                </div>
              </div>
             
            </div>
            <hr>
            <h4 class="card-title">Description</h4>
            <div class="row">
              <div class="col-md-12">
                 <textarea id="summernoteExample" name="message" cols="86" rows ="20" style="border-color: aqua;">{{$product->message}}</textarea> 
            </div>
          </div>
          <hr>
             <button type="submit" name="submit" class="btn btn-success">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>

  
@endsection