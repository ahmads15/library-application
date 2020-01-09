@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3" style="margin-bottom: 50px">
            <div id="" style="margin-top: 5%">
                @include('layouts.partials.alerts')
                <h3 style="text-align: center">
                    <strong>Edit {{$users->name}}'s Data</strong>
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
                        <label for="">Nama</label>
                        <input type="text" name="name" class="form-control" value="{{$users->name}}">
                    </div>

                    <div class="form-group" style="margin: 20px">
                        <label for="">Username</label>
                        <input type="text" name="username" class="form-control" value="{{$users->username}}">
                    </div>

                    <div class="form-group" style="margin: 20px">
                        <label for="">Password</label>
                        <input type="text" name="password" class="form-control" placeholder="Password">
                    </div>

                    <div class="form-group" style="margin: 20px">
                        <label for="">Password Confirm</label>
                        <input type="text" name="password_confirmation" class="form-control" placeholder="Password Confirm">
                    </div>

                    <div class="form-group" style="margin: 20px">
                        <label for="">Email</label>
                        <input type="text" name="email" class="form-control" value="{{$users->email}}">
                    </div>

                    <div class="form-group" style="margin: 20px">
                        <label for="">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{$users->phone}}">
                    </div>

                    <div class="form-group" style="margin: 20px">
                        <label for="">Birthday</label>
                        <input name="birthday" type="date" class="form-control" value="{{$users->birthday}}">
                    </div>

                    <div class="form-group" style="margin: 20px">
                        <label for="gender">Gender</label>
                        <div>
                            <label for="gender-m" style="margin-right: 20px; font-weight: 100">
                                <input id="gender-m" type="radio" name="gender" value="Male" {{ ($users->gender == 'Male') ? 'checked' : '' }}> Male
                            </label>

                            <label for="gender-f" style="font-weight: 100">
                                <input id="gender-f" type="radio" name="gender" value="{{$users->gender}}" {{ ($users->gender == 'Female') ? 'checked' : '' }}> Female
                            </label>
                        </div>
                    </div>

                    <div class="form-group" style="margin: 20px; margin-bottom: 10px">
                        <label for="photo">Photo</label>
                        <div>
                            <label class="btn-upload">

                                <input type="file" name="photo" value="{{$users->photo}}">

                                <button class="btn">
                                    <i class="fa fa-upload"></i><br>
                                    Choose An Image File
                                </button>
                            </label>

                        </div>

                    </div>


                    <div class="col-md-offset-4">
                        <a href="{{url('manage-user')}}"></a>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 