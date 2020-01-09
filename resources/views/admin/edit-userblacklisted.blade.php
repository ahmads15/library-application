@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3" style="margin-bottom: 50px">
            <div id="" style="margin-top: 5%">
                @include('layouts.partials.alerts')
                @if ($errors->any())
                <div class="form-group">
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                </div>
                @endif
                <h3 style="text-align: center">
                    <strong>Edit's BlackList History</strong>
                </h3>

                <form action="" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}

                    <div class="form-group" style="margin: 20px">
                        <label for="">Username</label>
                        <select class="form-control" name="username">
                        <option value="" selected disabled>-- Select Username --</option>
                            @foreach($users as $user)
                            <option value="{{$user->id}}" {{$user->id == $datauser->user_id ? 'selected' : ''}}>{{$user->username}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" style="margin: 20px">
                        <label for="">Status</label>
                        <select class="form-control" name="status">
                        <option value="" selected disabled>-- Select Status --</option>
                            @foreach($statusblacklisted as $status)
                            <option value="{{$status->id}}" {{$status->id == $datauser->status_id ? 'selected' : ''}}>{{$status->status}}</option>
                            @endforeach
                        </select>
                    </div>

  
                    <div class="form-group" style="margin: 20px">
                        <label for="">Description </label>
                        <div>
                            <textarea name="description" id="" lass="form-control"  cols="68" rows="10" >{{$datauser->description}}</textarea>
                        </div>
                    </div>
     
                    <div class="col-md-offset-4">
                        <a href="{{url('user-blacklisted')}}"></a>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 