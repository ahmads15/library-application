@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3" style="margin-bottom: 50px">
            <div id="register" style="margin-top: 5%">
                <h3 style="text-align: center">
                    <strong>Registration</strong>
                    {{ $errors->first()}}

                </h3>

                <form action="{{route('register')}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group" style="margin: 20px">
                        <input type="text" name="name" class="form-control" placeholder="Name">
                    </div>

                    <div class="form-group" style="margin: 20px">
                        <input type="text" name="username" class="form-control" placeholder="Username">
                    </div>

                    <div class="form-group" style="margin: 20px">
                        <input type="text" name="password" class="form-control" placeholder="Password">
                    </div>

                    <div class="form-group" style="margin: 20px">
                        <input type="text" name="password_confirmation" class="form-control" placeholder="Password Confirm">
                    </div>

                    <div class="form-group" style="margin: 20px">
                        <input type="text" name="email" class="form-control" placeholder="Email">
                    </div>

                    <div class="form-group" style="margin: 20px">
                        <input type="text" name="phone" class="form-control" placeholder="Phone">
                    </div>

                    <div class="form-group" style="margin: 20px">
                        <input name="birthday" type="date" class="form-control">
                    </div>

                    <div class="form-group" style="margin: 20px">
                        <div>
                            <label for="gender-m" style="margin-right: 20px; font-weight: 100">
                                <input id="gender-m" type="radio" name="gender" value="Male" {{ (old('gender') == 'Male') ? 'checked' : '' }}> Male
                            </label>

                            <label for="gender-f" style="font-weight: 100">
                                <input id="gender-f" type="radio" name="gender" value="Female" {{ (old('gender') == 'Female') ? 'checked' : '' }}> Female
                            </label>
                        </div>
                    </div>

                    <div class="form-group" style="margin: 20px; margin-bottom: 10px">
                        <label class="btn-upload">
                            <input type="file" name="photo">

                            <button class="btn">
                                <i class="fa fa-upload"></i><br>
                                Choose An Image File
                            </button>
                        </label>
                    </div>

                    <div class="form-group" style="margin-left: 20px">
                        <div class="checkbox">
                            <label>
                                <input id="agreement" type="checkbox" name="agreement" value="1"> I agree with term and condition
                            </label>
                        </div>
                    </div>

                    <div class="form-group" style="margin: 20px">
                        <button class="btn btn-primary" style="text-align: center; width: 100%">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
