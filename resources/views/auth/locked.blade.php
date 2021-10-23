<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/melody/template/pages/samples/lock-screen.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:08:54 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Melody Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ URL::asset('vendors/iconfonts/font-awesome/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('vendors/css/vendor.bundle.addons.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth lock-full-bg">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-transparent text-left p-5 text-center">
                @if(Auth::user()->image)
                    <img class="lock-profile-img" src="{{asset('/storage/image/'.Auth::user()->image)}}" alt="image" >
                @endif
              <form method="POST" action="{{ route('unlock') }}" aria-label="{{ __('Locked') }}" class="pt-5">
                @csrf
                <div class="form-group">
                    <label for="examplePassword1" >{{ __('Password to unlock') }}</label>
                        <input id="password" type="password"  class="form-control text-center{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                </div>
                <div class="mt-5">
                    <button type="submit" class="btn btn-block btn-success btn-lg font-weight-medium">
                        {{ __('Unlock') }}
                    </button>
                </div>
                <div class="mt-3 text-center">
                  <a href="{{ route('login') }}" class="auth-link text-white">Sign in using a different account</a>
                </div>
            </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ URL::asset('vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ URL::asset('vendors/js/vendor.bundle.addons.js') }}"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="{{ URL::asset('js/off-canvas.js') }}"></script>
  <script src="{{ URL::asset('js/hoverable-collapse.js') }}"></script>
  <script src="{{ URL::asset('js/misc.js') }}"></script>
  <script src="{{ URL::asset('js/settings.js') }}"></script>
  <script src="{{ URL::asset('js/todolist.js') }}"></script>
  <!-- endinject -->
</body>


<!-- Mirrored from www.urbanui.com/melody/template/pages/samples/lock-screen.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 15 Sep 2018 06:08:54 GMT -->
</html>
