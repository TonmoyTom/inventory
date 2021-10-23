@extends('layouts.app')

@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <h3 class="page-title" style=" margin-bottom: 50px;">
          Product View
        </h3>

                    <div style="margin-bottom: 20px; margin-left: 50px;">
                       ,<p></p> Product Name : {{$product->product_name}}
                    </div>     
                    <div style="margin-bottom: 20px;margin-left: 50px; ">
                        Product Code :{{$product->product_code}}
                    </div> 
                    <div style="margin-bottom: 20px;margin-left: 50px;">
                        Category:{{$product->category->category_name}}
                    </div> 
                    <div style="margin-bottom: 20px;margin-left: 50px;">
                        BarCodes:{{$product->barcode}}
                    </div> 
                    <div style="margin-bottom: 20px;margin-left: 50px;">
                        Product Image :<img style="width: 50px; height: 50px; border-radius:0px;" width="40px" width="40px" src="{{asset('/storage/product/'.$product->product_image_one)}}">
                    </div> 

                    
                    @if ($product->product_image_two == NULL)
                            
                    @else
                    <div style="margin-bottom: 20px;margin-left: 50px;">
                        Product Image :<img style="width: 50px; height: 50px; border-radius:0px;" width="40px" width="40px" src="{{asset('/storage/product/'.$product->product_image_two)}}">
                    </div>  
                    @endif
                   
                    
                    <div style="margin-bottom: 20px;margin-left: 50px;">
                        Product Quantity :{{$product->qty}}
                    </div> 
                    <div style="margin-bottom: 20px;margin-left: 50px;">
                        Minimum Quantity  :{{$product->min_qty}}
                    </div> 
                    <div style="margin-bottom: 20px;margin-left: 50px;">
                        Product Price :{{$product->product_price}}
                    </div> 
                    <div style="margin-bottom: 20px;margin-left: 50px;">
                        Whole Price:{{$product->whole_price}}
                    </div> 
                    <div style="margin-bottom: 20px;margin-left: 50px;">
                        Retail Price :{{$product->retail_price}}
                    </div> 
                    <div style="margin-bottom: 20px;margin-left: 50px;">
                        Description :{{$product->message}}
                    </div> 
    </div>
</div>     


@endsection