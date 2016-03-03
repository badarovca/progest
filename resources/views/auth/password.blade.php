@extends('layouts.app')

<!-- Main Content -->
@section('content')

<div class="login-box">
    <div class="login-logo">
        <a href="{{url('/')}}"><b>PRO</b>Gest</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        <p class="login-box-msg">Informe seu email</p>

        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
            <input type="hidden" value="{{csrf_token()}}" name="_token">
            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
    </div>


    <div class="row">
        <div class="col-xs-4 col-xs-offset-8">
            <button type="submit" class="btn btn-success btn-block btn-flat">Enviar</button>

        </div>
    </div>
</form>

</div>
<!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection
