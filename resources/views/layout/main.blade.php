<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>mainpage</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets2/src/assets/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets2/src/assets/css/styles.min.css') }}" />
</head>
<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="relative">
    
        @include('layout.sidebar')
        
        <div class="body-wrapper">
          
          @include('layout.navbar')
          
          <div class="container-fluid">
            {{-- @include('layout.ADMIN.page') --}}
            @yield('content')
          </div>
        </div>
      </div>

    <script src="{{ asset('assets2/src/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets2/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets2/src/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets2/src/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets2/src/assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>