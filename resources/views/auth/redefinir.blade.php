@extends('layouts.app')

@section('content')

<div class="register-box">
    <div class="register-logo">
        <a href="{{url('/')}}"><b>PRO</b>Gest</a>
    </div>



    <div class="register-box-body">
        @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
        <a class="pull-right" href="{{url('/')}}">Voltar</a>
        @endif
        
        <p class="login-box-msg">Redefinir senha</p>

        <form role="form" method="POST" action="{{ url('update-senha') }}">
            <input type="hidden" value="{{csrf_token()}}" name="_token">
            <div class="form-group has-feedback {{ $errors->has('old_password') ? ' has-error' : '' }}">
                <input type="password" name="old_password" value="{{ old('email') }}" class="form-control" placeholder="Senha atual">
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                @if ($errors->has('old_password'))
                <span class="help-block">
                    <strong>{{ $errors->first('old_password') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" name="password" class="form-control" placeholder="Nova senha">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirme a nova senha">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-4 col-xs-offset-8">
                    <button type="submit" class="btn btn-success btn-block btn-flat">Salvar</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.form-box -->
</div>
@endsection
