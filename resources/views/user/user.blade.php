@extends('layouts.app')

@section('content')
<div class="main-panel">
<div class="content-wrapper">
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
                    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Name</label>
                        <input type="text" class="form-control" name="name">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Eamil</label>
                        <input type="email" class="form-control" name="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Password</label>
                        <input type="password" class="form-control" name="password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Image</label>
                        <input type="file" class="form-control dropify" name="image" >

                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal-4" data-whatever="@mdo">Add User </button>
          </div>
        </div>
      </div>
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Time</th>
                    <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @php $count=0; @endphp
                @foreach($users as $user)
                @php $count+=1 @endphp
                <tr>
                    <td>{{$count}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                    {{-- <td>
                      @if(APP\User::where('id',Auth::user()->id)->first() )
                      @else 
                      <a href="{{ route('message',['id' => Crypt::encrypt($user->id)])}}" class="btn btn-info btn-icon-text">Message
                        <i class="fas fa-pencil-alt btn-icon-append"></i>   
                      </a>
                     @endif 
                    </td> --}}
                    <td>
                      <div class="btn-group">
                        <a href="{{ route('userupdate',['id' => Crypt::encrypt($user->id)])}}" class="btn btn-dark btn-icon-text">Edit
                          <i class="fas fa-pencil-alt btn-icon-append"></i>   
                        </a>
                          <form action="{{ route('user.delete', ['id' => Crypt::encrypt($user->id)]) }}" method="post">
                              @method('delete')
                              @csrf
                              <button type="submit" id="delete" data-name="{{ $user->name }}" class="btn btn-danger btn-icon-text right delete-confirm"> 
                                <i class="fas fa-trash-alt btn-icon-prepend"></i>
                                 Delete
                              </button>   
                          </form>
                      </div> 
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
</div>

@endsection