<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    @yield('css')
  </head>
  <body>
    <!-- As a link -->
    <nav class="navbar bg-grey border-bottom">
        <div class="container-fluid">
            <img 
                src="https://sudoconsultants.com/wp-content/uploads/2022/10/sudo-full-logo.png" 
                alt=""
                width="100"
                height="25"
            >
            <a class="text-black text-decoration-none p-2" href="#">Cadastrar</a>
        </div>
    </nav>

    <main class="container mt-5" style="">
        <div class="row row-cols-1 row-cols-lg-1 g-2 g-lg-3">
            <div class="col">
                @yield('content')
            </div>
        </div>
    </main>


    @yield('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>