<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Inventory') }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ URL::asset('vendors/iconfonts/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('vendors/css/vendor.bundle.addons.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('vendors/summernote/dist/summernote-bs4.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    <!-- endinject -->
    {{-- <link rel="stylesheet" href={{ URL::asset('../../css/style.css') }}> --}}
    <!-- endinject -->
    <link rel="shortcut icon" href="../../images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
 
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ URL::asset('sweetalert2.min.css')}}">
    
</head>
<body>
  @guest
  @else
      

    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar">
          <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="index-2.html"><img src="{{ URL::asset('images/logo.svg')}}" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="index-2.html"><img src="{{ URL::asset('images/logo-mini.svg')}}" alt="logo"/></a>
          </div>
          <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="fas fa-bars"></span>
            </button>
            <ul class="navbar-nav">
              <li class="nav-item nav-search d-none d-md-flex">
                <div class="nav-link">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fas fa-search"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control" placeholder="Search" aria-label="Search">
                  </div>
                </div>
              </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">
              <li class="nav-item dropdown d-none d-lg-flex">
                <div class="nav-link">
                  <span class=" btn btn-outline-dark" >English</span>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                  <i class="fas fa-bell mx-0"></i>
                  <span class="count">16</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                  <a class="dropdown-item">
                    <p class="mb-0 font-weight-normal float-left">You have 16 new notifications
                    </p>
                    <span class="badge badge-pill badge-warning float-right">View all</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-danger">
                        <i class="fas fa-exclamation-circle mx-0"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <h6 class="preview-subject font-weight-medium">Application Error</h6>
                      <p class="font-weight-light small-text">
                        Just now
                      </p>
                    </div>
                  </a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                  <i class="fas fa-envelope mx-0"></i>
                  @php
                  $messagedata = App\message::with('user')->where('messager_id',Auth::id())->Where('status',0)->get();
                  @endphp
                  <span class="count">{{$messagedata->count()}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                  <div class="dropdown-item">
                    <p class="mb-0 font-weight-normal float-left">You have {{$messagedata->count()}} unread mails
                    </p>
                    <span class="badge badge-info badge-pill float-right"><a style="color: #fff;" href="{{ route('message.data') }}">View all</a></span>
                  </div>
                  <div class="dropdown-divider"></div>

                  @php
                      $messagedata = App\message::with('user')->where('messager_id',Auth::id())->orderBy('id', 'DESC')->limit(4)->get();
                  @endphp
                  @foreach ($messagedata as $messages)
                
                  <a   @if($messages->status == "0")
                    {{$color = "bold" ?? '' }}
                    @else
                      {{$color = "normal" ?? '' }}
                    @endif
                      class="dropdown-item preview-item" href="{{ route('message.view',['id' => $messages->id]) }}">
                    <div class="preview-thumbnail">
                        <img src="{{asset('/storage/image/'.$messages->user->image)}}" alt="image" class="profile-pic">
                    </div>
                    <div class="preview-item-content flex-grow">
                      <h6 class="preview-subject ellipsis" style="font-weight: {{$color}}">{{$messages->user->name}}
                        <span class="float-right  small-text" >{{$messages->created_at->diffForHumans()}}</span>
                      </h6>
                      <p class=" small-text"style="font-weight: {{$color}}" >
                        {{Str::limit($messages->message,10 )}}
                      </p>
                    </div>
                  </a>
                
                  @endforeach
                </div>
              </li>
              <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                @if(Auth::user()->image)
                  <img  src="{{asset('/storage/image/'.Auth::user()->image)}}" alt="image" >
                @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                  <a href="{{ route('userupdate',['id' => Crypt::encrypt(Auth::user()->id)])}}" class="dropdown-item">
                    <i class="fas fa-cog text-primary"></i>
                    Settings
                  </a>
                  <div class="dropdown-divider"></div>
                  
                  <a href="{{ route('logout') }}" class="dropdown-item"  onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                     <i class="fas fa-power-off text-primary"></i> {{ __('Logout') }} 
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
                  </a>
                </div>
              </li>
              <li class="nav-item nav-settings d-none d-lg-block">
                <a class="nav-link" href="#">
                  <i class="fas fa-ellipsis-h"></i>
                </a>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="fas fa-bars"></span>
            </button>
          </div>
        </nav>

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
          <!-- partial:partials/_settings-panel.html -->
          <div class="theme-setting-wrapper">
            <div id="settings-trigger"><i class="fas fa-fill-drip"></i></div>
            <div id="theme-settings" class="settings-panel">
              <i class="settings-close fa fa-times"></i>
              <p class="settings-heading">SIDEBAR SKINS</p>
              <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
              <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
              <p class="settings-heading mt-2">HEADER SKINS</p>
              <div class="color-tiles mx-0 px-4">
                <div class="tiles primary"></div>
                <div class="tiles success"></div>
                <div class="tiles warning"></div>
                <div class="tiles danger"></div>
                <div class="tiles info"></div>
                <div class="tiles dark"></div>
                <div class="tiles default"></div>
              </div>
            </div>
          </div>
          <div id="right-sidebar" class="settings-panel">
            <i class="settings-close fa fa-times"></i>
            <ul class="nav nav-tabs" id="setting-panel" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
              </li>
            </ul>
            <div class="tab-content" id="setting-content">
              <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
                <div class="add-items d-flex px-3 mb-0">
                  <form class="form w-100">
                    <div class="form-group d-flex">
                      <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                      <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task-todo">Add</button>
                    </div>
                  </form>
                </div>
                <div class="list-wrapper px-3">
                  <ul class="d-flex flex-column-reverse todo-list">
                    <li>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="checkbox" type="checkbox">
                          Team review meeting at 3.00 PM
                        </label>
                      </div>
                      <i class="remove fa fa-times-circle"></i>
                    </li>
                  </ul>
                </div>
               
               
              </div>
              <!-- To do section tab ends -->
              <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
                <div class="d-flex align-items-center justify-content-between border-bottom">
                  <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
                  <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
                </div>
                <ul class="chat-list">
                  <li class="list active">
                    <div class="profile"><img src="images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                    <div class="info">
                      <p>Thomas Douglas</p>
                      <p>Available</p>
                    </div>
                    <small class="text-muted my-auto">19 min</small>
                  </li>
                </ul>
              </div>
              <!-- chat tab ends -->
            </div>
          </div>
          <!-- partial -->
          <!-- partial:partials/_sidebar.html -->

          <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
              <li class="nav-item nav-profile">
                <div class="nav-link">
                  <div class="profile-image">
                    @if(Auth::user()->image)
                    <img  src="{{asset('/storage/image/'.Auth::user()->image)}}" alt="image" >
                    @endif
                  </div>
               
                  <div class="profile-name">
                    <p class="name">
                      {{ Auth::user()->name }}
                    </p>
                    <p class="designation">
                      Super Admin
                    </p>
                  </div>
                </div>
              </li>



              @if (Auth::user()->status == 1)
              <li class="nav-item">
                <a class="nav-link" href="{{route('home')}}">
                  <i class="fa fa-home menu-icon"></i>
                  <span class="menu-title">Dashboard</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('categories')}}">
                  <i class="fa fa-puzzle-piece menu-icon"></i>
                  <span class="menu-title">Categories</span>
                </a>
              </li>
              <li class="nav-item d-none d-lg-block">
                <a class="nav-link" data-toggle="collapse" href="#sidebar-layouts" aria-expanded="false" aria-controls="sidebar-layouts">
                  <i class="fas fa-columns menu-icon"></i>
                  <span class="menu-title">Users</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="sidebar-layouts">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('user')}}">All User</a></li>
                  </ul>
                </div>
              </li>
            
              <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                  <i class="far fa-compass menu-icon"></i>
                  <span class="menu-title">Message</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('message.user')}}">User</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('message.data')}}">Inbox</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('message.sent')}}">SentBox</a></li>
                  </ul>
                  </div>
              </li> 
              <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-advanced" aria-expanded="false" aria-controls="ui-advanced">
                  <i class="fas fa-clipboard-list menu-icon"></i>
                  <span class="menu-title">Product</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-advanced">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link"href="{{route('product')}}">New Product</a></li>
                    <li class="nav-item"> <a class="nav-link"href="{{route('product.data')}}">All Product</a></li>
                  </ul>
                </div>
              </li>

              <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#apps" aria-expanded="false" aria-controls="apps">
                  <i class="fas fa-briefcase menu-icon"></i>
                  <span class="menu-title">Expense</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="apps">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('expense')}}"> Add Expense </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('expense.view')}}"> Expense </a></li>

                  </ul>`
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                  <i class="fas fa-file menu-icon"></i>
                  <span class="menu-title">Supplier</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="general-pages">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('supplier')}}">Add Supplier</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('supplier.view')}}">Supplier</a></li>

                  </ul>
                </div>
              </li>

              <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#e-commerce" aria-expanded="false" aria-controls="e-commerce">
                  <i class="fas fa-shopping-cart menu-icon"></i>
                  <span class="menu-title">purchase</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="e-commerce">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('Purchase')}}"> Add purchase </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('purchase.all')}}"> purchase </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('purchase.return')}}"> purchase Return </a></li>
                  </ul>
                </div>
              </li>

              <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                  <i class="fas fa-window-restore menu-icon"></i>
                  <span class="menu-title">Customer</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="auth">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('customer')}}"> Add Customer </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('customer.view')}}"> Customer </a></li>
                  </ul>
                </div>
              </li>

              <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                  <i class="fa fa-stop-circle menu-icon"></i>
                  <span class="menu-title">Sale</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="icons">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('sales')}}">Add Sales</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('sales.all')}}">Sales</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('sales.return')}}">Sales Return</a></li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
                  <i class="fas fa-exclamation-circle menu-icon"></i>
                  <span class="menu-title">Report</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="error">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('purchasereport')}}"> Purchase Report </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('purchasereturnreoprt')}}"> Purchase Return Report</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('purchasepaid')}}"> Purchase Paid </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('salesreoprt')}}"> Slaes Report </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('salesreturnreoprt')}}"> Sales Return Report </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('salespaid')}}"> Sales Return Report </a></li>
                    <li class="nav-item"> <a class="nav-link" href=""> 500 </a></li>
                  </ul>
                </div>
              </li>
              @elseif(Auth::user()->status == 2)
              <li class="nav-item">
                <a class="nav-link" href="{{route('home')}}">
                  <i class="fa fa-home menu-icon"></i>
                  <span class="menu-title">Dashboard</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('categories')}}">
                  <i class="fa fa-puzzle-piece menu-icon"></i>
                  <span class="menu-title">Categories</span>
                </a>
              </li>
              <li class="nav-item d-none d-lg-block">
              <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                  <i class="far fa-compass menu-icon"></i>
                  <span class="menu-title">Message</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('message.user')}}">User</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('message.data')}}">Inbox</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('message.sent')}}">SentBox</a></li>
                  </ul>
                  </div>
              </li> 
              @endif   
            </ul>
          </nav>
   
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    
                                </a>

                               
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}

       
           
 


        
    @endguest
    @yield('content')
 <!-- partial:partials/_footer.html -->
 
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
</body>



<!-- plugins:js -->
<script src="{{ URL::asset('vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ URL::asset('vendors/js/vendor.bundle.addons.js') }}"></script>
<script src="{{ URL::asset('vendors/summernote/dist/summernote-bs4.min.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="{{ URL::asset('js/off-canvas.js') }}"></script>
<script src="{{ URL::asset('js/hoverable-collapse.js') }}"></script>
<script src="{{ URL::asset('js/misc.js') }}"></script>
<script src="{{ URL::asset('js/settings.js') }}"></script>
<script src="{{ URL::asset('js/todolist.js') }}"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="{{ URL::asset('js/dashboard.js') }}"></script>
<script src="{{ URL::asset('js/ajax.js') }}"></script>
<script src="{{ URL::asset('js/data-table.js') }}"></script>
<script src="{{ URL::asset('js/dropzone.js') }}"></script>
<script src="{{ URL::asset('js/dropify.js') }}"></script>
<script src="{{ URL::asset('js/jquery-file-upload.js') }}"></script>
<script src="{{ URL::asset('js/editorDemo.js') }}"></script>
<script type="text/javascript" src="https://unpkg.com/vue@2.6.12/dist/vue.js"></script>
<!-- End custom js for this page-->

<script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
 <script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>
 <script>
        @if(Session::has('messege'))
          var type="{{Session::get('alert-type','info')}}"
          switch(type){
              case 'info':
                   toastr.info("{{ Session::get('messege') }}");
                   break;
              case 'success':
                  toastr.success("{{ Session::get('messege') }}");
                  break;
              case 'warning':
                 toastr.warning("{{ Session::get('messege') }}");
                  break;
              case 'error':
                  toastr.error("{{ Session::get('messege') }}");
                  break;
          }
        @endif
     </script> 

     
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script>  
  
$('.delete-confirm').click(function(event) {
var form =  $(this).closest("form");
var name = $(this).data("name");
event.preventDefault();
swal({
   title: `Are you sure you want to delete ${name}?`,
   text: "If you delete this, it will be gone forever.",
   icon: "warning",
   buttons: true,
   dangerMode: true,
})
.then((willDelete) => {
 if (willDelete) {
   form.submit();
 }else {
    swal("Cancel");
  }
});
});
</script>
@stack('js')
</html>
