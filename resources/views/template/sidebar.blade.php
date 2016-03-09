<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">GERENCIAR</li>
            <!-- Optionally, you can add icons to the links -->
            <!--<li><a href="#"><span>Setores</span></a></li>-->
            <!--            <li class="treeview">
                            <a href="#"><span>Usuários</span> <i class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li><a href="#">Usuários</a></li>
                                <li><a href="#">Setores</a></li>
                                <li><a href="#">Coordenações</a></li>
                            </ul>
                        </li>-->
            @if(Auth::user()->hasRole('admin'))
            <li class="treeview">
                <a href="#"><span>Cadastros</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.usuarios.index')}}"><span>Usuários</span></a></li>
                    <li><a href="{{ route('admin.setores.index')}}"><span>Setores</span></a></li>
                    <li><a href="{{ route('admin.coordenacoes.index')}}"><span>Cordenações</span></a></li>
                    <li><a href="{{ route('admin.fornecedores.index')}}"><span>Fornecedores</span></a></li>
                    <li><a href="{{ route('admin.subitens.index')}}">SubItens</a></li>
                    <li><a href="{{ route('admin.unidades.index')}}">Unidades</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><span>Estoque</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.materiais.index')}}">Materiais</a></li>
                </ul>
            </li>
            @endif
            <li class="treeview">
                <a href="#"><span>Movimentação</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.empenhos.index')}}">Empenhos</a></li>
                    <li><a href="{{ route('admin.entradas')}}">Entradas</a></li>
                    <li><a href="{{ route('admin.pedidos.index')}}">Pedidos</a></li>
                    <li><a href="{{ route('admin.saidas.index')}}">Saídas</a></li>
                </ul>
            </li>

        </ul><!-- /.sidebar-menu 
    </section>
        <!-- /.sidebar -->
</aside>
