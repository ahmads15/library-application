@extends('layouts.app')
@section('content')
<div class="container">
    <br><br>
    <br>
    @include('layouts.partials.alerts')
    <h2 style="text-align:center"> <i class="fa fa-book" aria-hidden="true"></i> Manage Books</h2>
    <div class="row">
        <div class="col-md-12" style="margin: 25px">
            <form action="{{url('Managebooks-search')}}" method="POST">
                {{csrf_field()}}
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by Book Name, Book Description, Book Category Name, or Shelf Location">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-secondary">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    
    <div class="row">
        @if(isset($search))
        <div class="col-md-12" style="">
            <p>Your Search Result with '<b>{{$search}}</b>' Keyword(s)</p>
        </div>
        @endif
    </div>

    <br><br>
    <div style="text-align: right">
        <a href="{{url('add-book')}}" class="btn btn-success"> <span class="glyphicon glyphicon-plus">Add New Book    
            </span></a>
    </div>
    <br>
    <table class="table">
        <tr>
            <th style="text-align: center">
                <h4><strong>Name</strong></h4>
            </th>
            <th style="text-align: center">
                <h4><strong>Description</strong></h4>
            </th>
            <th style="text-align: center">
                <h4><strong>Stock</strong></h4>
            </th>
            <th style="text-align: center">
                <h4><strong>Category</strong></h4>
            </th>
            <th style="text-align: center">
                <h4><strong>Shelf</strong></h4>
            </th>
            <th style="text-align: center">
                <h4><strong>Action</strong></h4>
            </th>
        </tr>
        @foreach($books as $book)
        <tr style="text-align : center">
            <td>{{$book->name}}</td>
            <td>{{$book->description}}</td>
            <td>{{$book->stock}}</td>
            <td>{{$book->category}}</td>
            <td>{{$book->location}}</td>
            <td><a href="{{url("edit-book/$book->id")}}" class="btn btn-success">
                    <i class="fa fa-edit" aria-hidden="true"></i></a>
                    <button class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteAlert-{{$book->id}}"> <i class="fa fa-trash" aria-hidden="true"></i></button>
            </td>
        </tr>

        
        <!-- {{--Hidden modal delete--}} -->
        <div class="modal fade" id="modalDeleteAlert-{{$book->id}}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteAlertTitle" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="modal-title" id="modalDeleteAlertTitle">Hapus Buku</h3>
                    </div>
                    <div class="modal-body">
                        <h4>Apakah anda yakin ingin menghapus buku <strong>{{$book->name}}</strong> ?</h4>
                    </div>
                    <div class="modal-footer">
                         <form action="{{url('delete-book/'.$book->id)}}" method="POST">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button class="btn btn-primary">Hapus</button>
                        </form>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        <!-- <a href="{{url("delete-book/$book->id")}}"><button type="button" class="btn btn-primary">Hapus</button></a> -->
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </table>
    {{ $books->links()}}

  

</div>

<br><br><br>
<br><br><br>
<br><br><br>
<br><br>



@endsection 