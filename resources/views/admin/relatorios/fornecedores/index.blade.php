@extends('admin.admin_template')

@section('content')
<!--Content Wrapper. Contains page content -->
<div class = "content-wrapper">
    <!--Content Header (Page header) -->
    <section class = "content-header">
        <h1>
            {!! $page_title or "Relatório - fornecedores com fornecimento pendente" !!}
            <small>{!! $page_description or null !!}</small>
        </h1>
        @include('template.alerts')
        <!-- Busca e filtros -->
        <br>
        <br>
    </section>

    <!--Main content -->
    <section class = "content">
        <!--Your Page Content Here -->
        @yield('relatorio')
    </section><!--/.content -->
</div><!--/.content-wrapper -->
@stop

