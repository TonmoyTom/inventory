@extends('layouts.app')

@section('content')
<div class="main-panel">
    
    <div class="content-wrapper">
         <!-- Start Model --> 
      

        <!-- End Model --> 
      <div class="page-header">
        <h3 class="page-title">
          Data table
        </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Tables</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data table</li>
          </ol>
        </nav>
      </div>
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Category table</h4>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="order-listing" class="table">
                  <thead>
                    <tr>
                       
                        <th>To</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Time</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $count=0; @endphp
                    @foreach($sentmessage as $messages)
                    @php $count+=1 @endphp
                    <tr>
                        {{-- <td>{{$count}}</td>
                        <td>{{$messages->name}}</td> --}}
                        <td>{{$messages->email}}</td>
                        <td>
                            @if($messages->subject == NULL)
                            <p>(No Subject)</p>
                          @else
                          {{$messages->subject}}
                          @endif
                          </td>
                        <td width="900px">{{Str::limit($messages->message,20 )}}</td>
                        <td width ="74.4px">{{$messages->created_at->diffForHumans()}}</td>
                    
                      
                        <td>
                          <a href="{{ route('message.sentview',['id' => $messages->id]) }}" class="btn btn-warning btn-icon-text">View
                            <i class="fas fa-pencil-alt btn-icon-append"></i>   
                          </a>
                          <form action="{{ route('messagesent.delete',['id' => $messages->id]) }}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" id="delete" data-name="{{ $messages->name }}" class="btn btn-danger btn-icon-text right delete-confirm"> 
                              <i class="fas fa-trash-alt btn-icon-prepend"></i>
                               Delete
                            </button>   
                        </form>
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