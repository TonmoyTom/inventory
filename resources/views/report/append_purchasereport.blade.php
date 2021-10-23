
@if(!empty($purchasereport))
@foreach($purchasereport as $purchases)
                  @php
                  $count=0;
                  $count+=1;
                  $due =  $purchases->productprice - $purchases->totalprice;
                  @endphp
                  <tr>
                    <td>{{$count}}</td>
                    <td>{{$purchases->created_at->format('j M Y ')}}</td> 
                    <td>{{$purchases->supplier->name}}</td> 
                    <td>{{$purchases->productprice}}</td>
                    <td>{{$purchases->totalprice}}</td>
                    <td>{{$due}}</td>

                  </tr>
  @endforeach

  @endif