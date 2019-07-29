<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>i Negocio | Resumen</title>
	<script src="/js/app.js"></script>

	<!-- Favicon icon -->
    <link rel="icon" type="/assets/image/png" sizes="16x16" href="/assets/img/favicon.png">

		<!-- sweetalert2 -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.js"></script>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Datatable style -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">


    <!-- Icons -->
    <link rel="stylesheet" href="/assets/css/themify-icons.css">
	<!-- Tipografía -->
	<link href="https://fonts.googleapis.com/css?family=Nunito+Sans" rel="stylesheet">

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<link rel="stylesheet" href="/assets/css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">

</head>
<body>

<div class="preloader">
	<div class="loader">
		<div class="loader__figure"></div>
		<p class="loader__label">i Negocio</p>
	</div>
</div>
<div id="main-wrapper">
    <!-- Topbar header -->
    <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md navbar-light">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{route('resumen')}}">
                    <b>
                         <img src="/assets/img/i-gde.png" alt="homepage" class="light-logo">
                    </b>
                        <span class="hidden-xs" style=""><img id="logotipo" src="/assets/img/logo-hor-gde.png" alt="Logotipo"></span>
                </a>
            </div>
            <div class="navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                </ul>
                <ul class="navbar-nav my-lg-0">
                    <li class="nav-item dropdown u-pro">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<span class="hidden-md-down">¡Hola {{Auth::user()->nombres}}! </span>
													<img src="{{empty (Auth::user()->img_perfil) ? '/assets/img/default.jpg' : 'https://inegociotestbucket.s3-us-east-2.amazonaws.com/'.Auth::user()->img_perfil}}" alt="user" class="">
												</a>
                        <div class="dropdown-menu dropdown-menu-right animated flipInY">
                            <a href="{{route('perfil')}}" class="dropdown-item"><i class="ti-user"></i> Editar mi perfil</a>
                            <div class="dropdown-divider"></div>

														<a class="dropdown-item" href="{{ route('logout') }}"
															 onclick="event.preventDefault();
																						 document.getElementById('logout-form').submit();">
																<i class="fa fa-power-off"></i>
																{{ __('Cerrar sesión') }}
														</a>

														<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
																@csrf
														</form>
                        </div>
                    </li>
                </ul>

            </div>
	   </nav>
    </header>
    <!-- /Topbar header -->
    <!-- Menú Lateral -->
    <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar ps ps--theme_default ps--active-y" data-ps-id="2956b301-199e-ac47-8478-915e392d3a93">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav active">
                    <ul id="sidebarnav" class="in">
                        <li class=""> <a class="" href="{{route('resumen')}}"><i class="fa fa-bar-chart" aria-hidden="true"></i><span class="hide-menu">Resumen</span></a>
                        </li>
                        <li class=""> <a class="" href="{{route('proyectos.index')}}"><i class="fa fa-briefcase" aria-hidden="true"></i><span class="hide-menu">Proyectos</span></a>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-users" aria-hidden="true"></i><span class="hide-menu">Usuarios</span></a>
                            <ul aria-expanded="false" class="collapse">
                                @if (Auth::user()->rol->rol == 'Administrador' || Auth::user()->rol->rol == 'Cliente A' || Auth::user()->rol->rol == 'Colaborador A' || Auth::user()->rol->rol == 'Cliente B' || Auth::user()->rol->rol == 'Colaborador B')
                                    <li><a href="{{route('usuarios')}}">Todos los usuarios</a></li>
                                @endif
																@if (Auth::user()->rol->rol == 'Administrador' || Auth::user()->rol->rol == 'Cliente A' || Auth::user()->rol->rol == 'Colaborador A' || Auth::user()->rol->rol == 'Cliente B' || Auth::user()->rol->rol == 'Colaborador B')
                                    <li><a href="{{route('usuario.create')}}">Añadir Nuevo</a></li>
                                @endif
                            </ul>
                        </li>
                        <li class=""> <a class="" href="{{route('perfil')}}"><i class="fa fa-id-card-o" aria-hidden="true"></i><span class="hide-menu">Mi perfil</span></a>
                        </li>
                        <li class=""> <a class="" href="{{route('material.index')}}"><i class="fa fa-files-o" aria-hidden="true"></i><span class="hide-menu">Material de apoyo</span></a>
                        </li>
                        @if (Auth::user()->rol->rol == 'Administrador' || Auth::user()->rol->rol == 'Colaborador A')
                        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-newspaper-o" aria-hidden="true"></i><span class="hide-menu">Blog</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{route('publicaciones.index')}}">Publicaciones</a></li>
								<li><a href="{{route('categorias.index')}}">Categorias</a></li>
                            </ul>
                        </li>
                        @endif
                        <li>
													<a class="" href="{{ route('logout') }}"
														 onclick="event.preventDefault();
																					 document.getElementById('logout-form').submit();">
															<i class="fa fa-sign-out"></i>
															{{ __('Cerrar sesión') }}
													</a>
                        </li>
                    </ul>
                </nav>

            <!-- End Sidebar scroll-->
    </aside>
    <!-- /Menú Lateral -->
    <!-- Contenido -->
    <div class="page-wrapper">
			@yield('content')
    </div>
    <!-- /Contenido -->
    <footer class="footer text-center">
        2019 i Negocio. <a href="#" target="_blank">Aviso de privacidad</a> | <a href="#" target="_blank">Términos y condiciones</a>
    </footer>
</div>
	@yield('modal')
<!-- jQuery library -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<!-- Latest compiled JavaScript -->

<!-- DataTable -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<!-- Bootstrap Datatable -->
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<!-- Main JS -->
<script src="/assets/js/menu-lateral.js"></script>
<script src="/assets/js/main.js"></script>
@yield('script')
<!-- Include this after the sweet alert js file -->
@include('sweet::alert')
</body>

</html>
