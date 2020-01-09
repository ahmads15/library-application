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
                
                    <strong>Add User to Blacklist</strong>
                 
                </h3>

                <form action="{{url('add-userblacklisted')}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                   

                    <div class="form-group" style="margin: 20px">
                        <label for="">Username</label>
                        <select class="form-control" name="username">
                            <option value="" selected disabled>-- Select Username --</option>
                            @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->username}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" style="margin: 20px">
                        <label for="">Status</label>
                        <select class="form-control" name="status">
                            <option value="" selected disabled>-- Select Status --</option>
                            @foreach($statusblacklisted as $status)
                            <option value="{{$status->id}}">{{$status->status}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="margin: 20px">
                        <label for="">Description</label>
                        <div>
                            <textarea name="description" id="" lass="form-control" placeholder="Description" cols="68" rows="10"></textarea>
                        </div>

                    </div>
                    <div class="form-group" style="margin: 20px">
                        <button class="btn btn-primary" style="text-align: center; width: 100%">Add </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 