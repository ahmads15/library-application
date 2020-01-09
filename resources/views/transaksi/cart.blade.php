@extends('layouts.app')

@section('content')

<style>
    .book {
        margin: 10px;
        border: 1px solid #ddd;

    }

    .book-content {
        height: 40px;
        margin: 20px;
        text-align: center;
        vertical-align: middle;
    }

    .book-footer {
        margin: 10px;
        text-align: center;
        vertical-align: middle;
        color: red;
    }
  
</style>
<div class="container" style="height: 100vh;">

    @if((Auth::user()->role)=='member')
    <h1><u>Your Cart's</u> <i class="fa fa-shopping-cart"></i></h1>
    <br><br>
    <div class="row">

        <form action="{{url('confirm-borrow')}}" method="POST">
            {{csrf_field()}}
            <div class="col-md-12">
                @foreach($carts as $cart)
                <div class="col-md-3">
                    <div class="book">
                        <div class="book-content">
                            <p>{{$cart->name}}</p>

                        </div>
                        <hr style="border-top: 1px solid #ddd; margin: 0">
                        <div class="book-footer">
                            <a href="#" data-toggle="modal" data-target="#modalDeleteAlert-{{$cart->id}}" style="color:red">Remove</a>
                        </div>
                    </div>
                </div>



                <div class="modal fade" id="modalDeleteAlert-{{$cart->id}}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteAlertTitle" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h3 class="modal-title" id="modalDeleteAlertTitle">Hapus Cart</h3>
                        </div>
                        <div class="modal-body">
                            <h4>Apakah anda yakin ingin menghapus  <strong>{{$cart->name}}</strong> ?</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            <a href="{{url("delete-cart/$cart->id")}}"><button type="button" class="btn btn-primary">Hapus</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="books[]" value="{{$cart->book_id}}">
                
                @endforeach
            </div>

            <button class="btn btn-primary" style="text-align: center; width: 100%" >Confirm</button>
        </form>
        @endif
    </div>
    @endsection 