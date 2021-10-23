
@if(!empty($salesreport))
@foreach($salesreport as $sales)
                  @php
                  $count=0;
                  $count+=1;
                  $due =  $sales->productprice - $sales->totalprice;
                  @endphp
                  <tr>
                    <td>{{$count}}</td>
                    <td>{{$sales->created_at->format('j M Y ')}}</td> 
                    <td>{{$sales->customer->name}}</td> 
                    <td>{{$sales->productprice}}</td>
                    <td>{{$sales->totalprice}}</td>
                    <td>{{$due}}</td>

                  </tr>
  @endforeach

  @endif