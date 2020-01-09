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
                
                    <strong>Add New Book</strong>
                 

                </h3>

                <form action="{{url('add-book')}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                   

                    <div class="form-group" style="margin: 20px">
                        <label for="">Category</label>
                        <!-- <input type="text" name="category" class="form-control" placeholder="Category"> -->
                        <select class="form-control" name="category">
                            <option value="" selected disabled>-- Select Category --</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" style="margin: 20px">
                        <label for="">Shelf</label>
                        <!-- <input type="text" name="shelf" class="form-control" placeholder="Shelf"> -->
                        <select class="form-control" name="shelf">
                            <option value="" selected disabled>-- Select Shelf --</option>
                            @foreach($shelves as $shelf)
                            <option value="{{$shelf->id}}">{{$shelf->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" style="margin: 20px">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Name">
                    </div>

                    <div class="form-group" style="margin: 20px">
                        <label for="">Description</label>
                        <div>
                            <textarea name="description" id="" lass="form-control" placeholder="Description" cols="68" rows="10"></textarea>
                        </div>

                    </div>

                    <div class="form-group" style="margin: 20px">
                        <label for="">Stock</label>
                        <input type="text" name="stock" class="form-control" placeholder="Stock">
                    </div>

                    <div class="form-group" style="margin: 20px">
                        <button class="btn btn-primary" style="text-align: center; width: 100%">Add New Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 