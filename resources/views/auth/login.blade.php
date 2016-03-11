@extends('layouts.app')

@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="{{url('/')}}"><img class="img-fluid" src='{{asset('img/logo.png')}}' style="max-width: 350px"></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Informe suas credenciais de acesso</p>

        <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
            <input type="hidden" value="{{csrf_token()}}" name="_token">
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
                    <button type="submit" class="btn btn-success btn-block btn-flat">Entrar</button>

                </div>
            </div>
            <a class="text-green" href="{{ url('/password/email') }}">Esqueci a senha</a>
            <br>
            <!--<a href="{{ url('/auth/register') }}">Registre-se</a>-->
        </form>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@stop




