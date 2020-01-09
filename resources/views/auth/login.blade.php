@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div id="login" style="margin-top: 10%">
            @include('layouts.partials.alerts')
                <h3 style="text-align: center">
                    <strong>Login</strong>
                </h3>
                <form action="{{route('login')}}" class="form-horizontal" method="POST">
                    {{csrf_field()}}
                    <div class="form-group" style="margin: 20px">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input id="username" type="text" class="form-control" name="username" placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group" style="margin: 20px">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group" style="margin: 20px">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"> Remember Me
                            </label>
                        </div>
                    </div>
                    <div class="form-group" style="margin: 20px">
                        <button class="btn btn-primary" style="text-align: center; width: 100%">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
