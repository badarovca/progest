@extends('admin.admin_template')

@section('content')

<!--Content Wrapper. Contains page content -->
<div class = "content-wrapper">
    <!--Content Header (Page header) -->
    <section class = "content-header">
        <h1>
            {{ $page_title or "Bem-vindo," }}
            <small>{{Auth::user()->name}}!</small>
        </h1>
    </section>

    <!--Main content -->
    <section class = "content">
        <!--Your Page Content Here -->
        <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ $qtds['pedidos_pendentes'] }}</h3>

              <p>Pedidos Pendentes</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="{{ route('admin.pedidos.index')}}" class="small-box-footer">
              Visualizar <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $qtds['empenhos_abertos'] }}</h3>

              <p>Empenhos em aberto</p>
            </div>
            <div class="icon">
              <i class="ion ion-clipboard"></i>
            </div>
            <a href="{{ route('admin.empenhos.index')}}?status=pendente" class="small-box-footer">
              Visualizar <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>{{ $qtds['usuarios'] }}</h3>

              <p>Usuários</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('admin.usuarios.index')}}" class="small-box-footer">
              Visualizar <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $qtds['materiais_abaixo'] }}</h3>

              <p>Produtos abaixo do mínimo</p>
            </div>
            <div class="icon">
              <i class="fa fa-exclamation-circle"></i>
            </div>
            <a href="{{ route('admin.materiais.index') }}?qtd_min=abaixo_qtd_min" class="small-box-footer">
              Visualizar <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
      </div>
    </section><!--/.content -->
</div><!--/.content-wrapper -->
@stop