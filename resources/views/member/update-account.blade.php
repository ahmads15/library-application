@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3" style="margin-bottom: 50px">
            <div id="" style="margin-top: 5%">
            @include('layouts.partials.alerts')
                <h3 style="text-align: center">
                    <strong>Edit Account</strong>
                    

                </h3>

                <form action="" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    @if ($errors->any())
                    <div class="form-group">
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    </div>
                @endif
                    <div class="form-group" style="margin: 20px">
                        <label for="name">Username</label>
                        <input id="username" name="username" type="text" class="form-control" value="{{$users->username}}">
                    </div>

                    <div class="form-group" style="margin: 20px">
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" class="form-control" placeholder="password">

                    </div>

                    <div class="form-group" style="margin: 20px">
                        <label for="password_confirmation">Password Confirm</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" placeholder="password confirmation">

                    </div>

                    <div class="form-group" style="margin: 20px">
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" class="form-control" value="{{$users->email}}">

                    </div>

                    <div class="form-group" style="margin: 20px">
                        <label for="email">Phone</label>
                        <input id="phone" name="phone" type="phone" class="form-control" value="{{$users->phone}}">

                    </div>

            

                    <div class="col-md-offset-4">
                        <a href="{{url('/')}}"></a>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 