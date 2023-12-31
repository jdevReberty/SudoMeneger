<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{asset("assets/vendor/fontawesome-free/css/all.min.css")}}" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="{{asset("assets/css/sb-admin-2.min.css")}}" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}

    @yield('css')
  </head>
  <body>
    <!-- As a link -->
    <nav class="position-fixed mt-3 ml-3">
        <img 
          src="https://sudoconsultants.com/wp-content/uploads/2022/10/sudo-full-logo.png" 
          alt=""
          width="100"
          height="25"
        >
    </nav>

    <main class="container" style="">
        <div class="row row-cols-1 row-cols-lg-1 g-2 g-lg-3">
            <div class="col">
                @yield('content')
            </div>
        </div>
    </main>


    @yield('script')
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> --}}
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset("assets/vendor/jquery/jquery.min.js")}}"></script>
    <script src="{{asset("assets/vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset("assets/vendor/jquery-easing/jquery.easing.min.js")}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset("assets/js/sb-admin-2.min.js")}}"></script>
  </body>
</html>