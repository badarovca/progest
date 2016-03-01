
@extends('layouts.app')

@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="{{url('/')}}"><b>PRO</b>Gest</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Informe suas credenciais de acesso</p>

        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() !!}
            @if ($errors->has('password') || $errors->has('email'))
            <span class="help-block has-error">
                <strong>Email e/ou senha incorretos.</strong>
            </span>
            @endif
            <div class="form-group has-feedback {{ $errors->has('password') || $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email"/>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="row">
                <div class="col-xs-4 col-xs-offset-8">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>

                </div>
            </div>
            <a href="{{ url('/password/reset') }}">Esqueci a senha</a>
            <br>
            <a href="{{ url('/register') }}">Registre-se</a>
        </form>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@stop




