<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>
  <link rel="stylesheet" href="{{ '/css/appuse.css' }}">
  <!-- <link rel="stylesheet" href="{{ mix('/css/app.css') }}"> -->
  <!-- calendar css -->


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.css">
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/locale/es.min.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="s fa-bars"></i></a>
      </li>
    </ul>

    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>

  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <div class="sidebar">

      <a>
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
              </div>
              <div class="primary">
                 
                  <span class="d-block text-muted">
                  {{  session('nom_empleado')}}
                  </span>
              </div>
          </div>
        </>

      @include('layouts.sidebar')

    </div>

  </aside>


  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        {{-- <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Es Inicio</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div>
        </div><!-- /.row --> --}}
      </div>
    </div>
         <div class="page-wrapper">
            <div class="container-fluid">
                @yield('contenido')
            </div>
        </div>
  </div>


  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.0
    </div>
    <strong>Copi Rigth &copy; 2022 <a href="https://juanchosserver.shop">juanchosserver.shop</a>.</strong> All rights reserved.
  </footer>

</div>


@auth
<script>
    window.user = @json(auth()->user())
</script>
@endauth

<script src="{{ mix('/js/app.js') }}"></script>
<!-- calendar js -->
<script src="js/agenda.js"></script>

</body>
</html>
