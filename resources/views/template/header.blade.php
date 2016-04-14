<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/')}}" class="logo"><img class="img-fluid" src='{{asset('img/logo-horizontal.png')}}' style="max-width: 150px"></a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        @section('toogle-button')
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        @show
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                @yield('menu-pedidos')
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="{{ asset("/bower_components/admin-lte/dist/img/user.png") }}" class="user-image" alt="User Image"/>
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs"> {{Auth::user()->name}} </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="{{ asset("/bower_components/admin-lte/dist/img/user.png") }}" class="img-circle" alt="User Image" />
                            <p>
                                {{Auth::user()->name}} 
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ route('redefinir-senha') }}" class="btn btn-default btn-flat">Alterar Senha</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('/auth/logout') }}" class="btn btn-default btn-flat">Sair</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<input type="hidden" id="base_url" name="base_url" value="{{ url()}}">