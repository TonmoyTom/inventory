@extends('layouts.app')

@section('content')
<div class="main-panel">
    
    <div class="content-wrapper">
        
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
          <h4 class="card-title">Expense table</h4>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="order-listing" class="table">
                  <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $count=0; @endphp
                    @foreach($expense as $expenses)
                    @php $count+=1 @endphp
                    <tr>
                        <td>{{$count}}</td>
                        <td>{{$expenses->title}}</td>
                        <td>{{strip_tags($expenses->description)}}</td>
                        <td>{{$expenses->created_at->format('j M Y h:i A')}}</td>
                        
                        <td>{{$expenses->price}}</td>
                        <td>
                        
                            <div class="btn-group">
                              <a href="{{ route('expenseupdatepage',['id' => Crypt::encrypt($expenses->id)])}}" class="btn btn-dark btn-icon-text">Edit
                                <i class="fas fa-pencil-alt btn-icon-append"></i>   
                              </a>
                                <form action="{{ route('expenseupdate.delete', ['id' => Crypt::encrypt($expenses->id)]) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" id="delete" data-name="{{ $expenses->title }}" class="btn btn-danger btn-icon-text right delete-confirm"> 
                                      <i class="fas fa-trash-alt btn-icon-prepend"></i>
                                       Delete
                                    </button>   
                                </form>
                            </div>
                          {{-- <a href=""  class="btn btn-danger btn-icon-text">
                            <i class="fas fa-trash-alt btn-icon-prepend"></i>
                            Delete
                           </a> --}}
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