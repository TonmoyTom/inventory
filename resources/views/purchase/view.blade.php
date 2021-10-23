@extends('layouts.app')

@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <h3 class="page-title" style=" margin-bottom: 50px;">
          Product View
        </h3>

                    <div style="margin-bottom: 20px; margin-left: 50px;">
                       ,<p></p> Product Name : {{$purchase->product_name}}
                    </div>     
                    <div style="margin-bottom: 20px;margin-left: 50px; ">
                        Product Code :{{$purchase->product_code}}
                    </div> 
                    <div style="margin-bottom: 20px;margin-left: 50px;">
                        Category:{{$purchase->product->category->category_name}}
                    </div> 
                    <div style="margin-bottom: 20px;margin-left: 50px;">
                        BarCodes:{{$purchase->product->barcode}}
                    </div> 
                    <div style="margin-bottom: 20px;margin-left: 50px;">
                        Product Image :<img style="width: 50px; height: 50px; border-radius:0px;" width="40px" width="40px" src="{{asset('/storage/product/'.$purchase->product->product_image_one)}}">
                    </div> 

                    
                    @if ($purchase->product->product_image_two == NULL)
                            
                    @else
                    <div style="margin-bottom: 20px;margin-left: 50px;">
                        Product Image :<img style="width: 50px; height: 50px; border-radius:0px;" width="40px" width="40px" src="{{asset('/storage/product/'.$purchase->product->product_image_two)}}">
                    </div>  
                    @endif
                   
                    
                    <div style="margin-bottom: 20px;margin-left: 50px;">
                        Product Quantity :{{$purchase->product->qty}}
                    </div> 
                    <div style="margin-bottom: 20px;margin-left: 50px;">
                        Minimum Quantity  :{{$purchase->product->min_qty}}
                    </div> 
                    <div style="margin-bottom: 20px;margin-left: 50px;">
                        Product Price :{{$purchase->product->product_price}}
                    </div> 
                    <div style="margin-bottom: 20px;margin-left: 50px;">
                        Whole Price:{{$purchase->product->whole_price}}
                    </div> 
                    <div style="margin-bottom: 20px;margin-left: 50px;">
                        Retail Price :{{$purchase->product->retail_price}}
                    </div>  
                    
    </div>
</div>     


@endsection