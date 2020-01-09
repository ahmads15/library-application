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
                    <strong>Edit {{$shelves->name}}'s Data</strong>
                </h3>

                <form action="" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    
                    <div class="form-group" style="margin: 20px">
                        <label for="">Nama</label>
                        <input type="text" name="name" class="form-control" value="{{$shelves->name}}">
                    </div>


                    <div class="col-md-offset-4">
                        <a href="{{url('manage-shelf')}}"></a>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 