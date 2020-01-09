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
                    <strong>Edit '{{$databook->name}}' Book</strong>
                </h3>

                <form action="" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}

                    <div class="form-group" style="margin: 20px">
                        <label for="">Category</label>
                        <select class="form-control" name="category">
                        <option value="" selected disabled>-- Select Category --</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}" {{$category->id == $databook->category_id ? 'selected' : ''}}>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" style="margin: 20px">
                        <label for="">Shelf</label>
                        <select class="form-control" name="shelf">
                        <option value="" selected disabled>-- Select Shelf --</option>
                            @foreach($shelves as $shelf)
                            <option value="{{$shelf->id}}" {{$shelf->id == $databook->shelf_id ? 'selected' : ''}}>{{$shelf->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="margin: 20px">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" value="{{$databook->name}}">
                    </div>

                    <div class="form-group" style="margin: 20px">
                        <label for="">Description </label>
                        <div>
                            <textarea name="description" id="" lass="form-control"  cols="68" rows="10" >{{$databook->description}}</textarea>
                        </div>
                    </div>

                    <div class="form-group" style="margin: 20px">
                        <label for="">Stock</label>
                        <input type="text" name="stock" class="form-control" value="{{$databook->stock}}">
                    </div>

                    <div class="col-md-offset-4">
                        <a href="{{url('manage-book')}}"></a>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 