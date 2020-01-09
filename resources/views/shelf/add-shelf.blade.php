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
                    <strong>Add New Shelf</strong>


                </h3>

                <form action="{{url('add-shelf')}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}


                    <div class="form-group" style="margin: 20px">
                        <label for="">Nama</label>
                        <input type="text" name="name" class="form-control" placeholder="Name">
                    </div>

                    <div class="form-group" style="margin: 20px">
                        <button class="btn btn-primary" style="text-align: center; width: 100%">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 