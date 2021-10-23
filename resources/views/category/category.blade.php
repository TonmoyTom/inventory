@extends('layouts.app')

@section('content')
<div class="main-panel">
    
    <div class="content-wrapper">
         <!-- Start Model --> 
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Here all the product categories are listed.</h4>
                <div class="modal fade" id="exampleModal-4" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">Category List</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('categories.store')}}" method="POST">
                            @csrf
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Category</label>
                            <input type="text" class="form-control" name="category_name" placeholder="Category Name">
                          </div>
                        
                      </div>
                      <div class="modal-footer">
                        <button type="submit" name="submit" class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal-4" data-whatever="@mdo">Add Category </button>
              </div>
            </div>
          </div>

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
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $count=0; @endphp
                    @foreach($categories as $category)
                    @php $count+=1 @endphp
                    <tr>
                        <td>{{$count}}</td>
                        <td>{{$category->category_name}}</td>
                        <td>
                          @if($category->status == 1)
                          <a href="javascript:void(0)" class=" updateSectionstatus" id="category-{{$category->id }}"
                             section_id ="{{$category->id}}" >Active</a>
                          @else
                          <a  href="javascript:void(0)" class=" updateSectionstatus" id="category-{{$category->id }}"
                            section_id ={{$category->id}}">Deactive</a>
                          @endif
                        </td>
                        <td>
                        
                            <div class="btn-group">
                              <a href="{{ route('categorieupdatepage',['id' => Crypt::encrypt($category->id)])}}" class="btn btn-dark btn-icon-text">Edit
                                <i class="fas fa-pencil-alt btn-icon-append"></i>   
                              </a>
                                <form action="{{ route('categorieupdate.delete', ['id' => Crypt::encrypt($category->id)]) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" id="delete" data-name="{{ $category->name }}" class="btn btn-danger btn-icon-text right delete-confirm"> 
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