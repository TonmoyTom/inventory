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
            <h4 class="card-title"> Purchase Information</h4>
            <form class="form-sample" method="POST" action="{{route('sales.store')}}" >
              @csrf
              <p class="card-description">
                Sale info
              </p>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Product Name </label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="product_name" value="{{$product->product_name}}" />
                      <input type="hidden" class="form-control" name="product_id" id="product_id" value="{{$product->id}}" />
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
                    <label class="col-sm-3 col-form-label">Customer Name</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="customer_id">
                        <option>Select</option>
                      @foreach ($customer as $item)
                      <option value="{{$item->id}}">{{$item->name}}</option>
                      @endforeach
                       
                      </select>
                    </div>
                  </div>
                </div>  
                <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Status </label>
                      <div class="col-sm-9">
                        <select class="form-control" name="ostatus">
                            <option>Select</option>
                            <option value="0">Final</option>
                            <option value="1">Pending</option>
                            <option value="2">Ordered</option>
                            <option value="3">Return Order</option>
                          </select>
                          
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

              <h4 class="card-title">Price</h4>
              <hr>
              <div class="row">
                <div class="col-md-10">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label text-center"  >Product Price </label>
                    <div class="col-sm-9">
                      <input type="text"   name="whole_price"  class=" form-control getAtrPrice" id="input-price" value="{{$product->whole_price}}" >
                    </div>
                  </div>
                </div>
                
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label" >Color</label>
                    <div class="col-sm-9">
                     
                      <select class="form-control" name="colorid" id="colorid" product-id = {{$product->id}} >
                        <option>Select</option>
                      @foreach ($color as $item)
                      <option value="{{$item->id}}">
                        
                        {{$item->colorname}}
                       
                      </option>
                      @endforeach
                       
                      </select>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-6"   >
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label" >Size</label>
                      <div class="col-sm-9">
                        <select class="form-control" id="sizecolor" name="attribute_size" product-id = {{$product->id}} >
                        </select>
                     </div>
                  </div>
                </div>
                    

                 
                  
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label" for="input-qty">Quantity </label>
                      <div class="col-sm-9">
                        <input type="number" id="input-qty"  class="form-control" name="customer_qty" value="0"  />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label" for="input-total">Total Amount </label>
                      <div class="col-sm-9">
                        <input type="text" readonly class="form-control" name="productprice" id="input-total"  value="0"/>
                        
                      </div>
                    </div>
                  </div>
              </div>
            <hr>
            <h4 class="card-title">Amount Type</h4>

            <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label" > Amount </label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="totalprice" value="0" />
                      
                    </div>
                  </div>
                </div>
                 <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Payment Type</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="type">
                        <option>Select</option>  
                        <option value="0">Cash</option> 
                        <option value="1">Card</option> 
                        <option value="2">Other</option> 
                      </select>
                    </div>
                  </div>
                </div> 
                <div class="col-md-12">
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label">Note </label>
                      <div class="col-sm-9">
                        <textarea  name="note" cols="110 " rows ="4" style="border-color: aqua;"></textarea> 
                      </div>
                    </div>
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

@push('js')
    <script>
    $(function() {
    // jQuery methods go here...
    

   

    function setSize(){
        var colorid = $('#colorid').val(),
        product_id =$('#colorid').attr("product-id"),
        size_id =$('#selected-size').val();
        console.log('productid = '+product_id);
        // alert(product_id);
        $("#sizecolor").empty();
        $.ajax({
            type : 'post',
            url : '/salecolorsize',
            data : {colorid:colorid, product_id:product_id},
            dataType : 'json',
            success: function(result){
                $('#sizecolor').html('<option value="">Select Size</option>'); 
                $.each(result.getcolorsize,function(key,value){
                    if(value.size == null){
                        ("#sizecolor").append('');
                    }else{
                        let selected = size_id === value.size ? 'selected' : '';
                      
                        $("#sizecolor").append('<option '+ selected +' value="'+value.size+'">'+value.size+'</option>');
                    }
                        
                    });
                },error:function(result){
                alert("Please Select Your Color");
               }
           
        })
    }

    setSize();
    $("#colorid").change(function(){
        setSize();
    });
});

        // let input_qty = document.getElementById('input-qty');
        // let input_price = document.getElementById('input-price');
        // let input_total = document.getElementById('input-total');
        // input_qty.addEventListener('input', updateTotal);
        // input_price.addEventListener('input', updateTotal);
        // function updateTotal () {
        //     input_total.value = (parseInt(input_qty.value) * parseFloat(input_price.value))+"";
        // }
    </script>
@endpush

