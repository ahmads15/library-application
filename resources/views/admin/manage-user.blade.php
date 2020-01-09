@extends('layouts.app')
@section('content')
<div class="container">
    <br><br>
    <br>
    @include('layouts.partials.alerts')
    <h2 style="text-align:center"> <i class="fa fa-user" aria-hidden="true"></i> Manage Users</h2>
    <div class="row">
        <div class="col-md-12" style="margin: 25px">
            <form action="{{url('users-search')}}" method="POST">
                {{csrf_field()}}
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by Username, Role, Name, Email, Phone, Birthday or Gender">
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
        <a href="{{url('add-member')}}" class="btn btn-success"> <span class="glyphicon glyphicon-plus">Add new member
            </span></a>
    </div>
    <br>
    <table class="table">
        <tr>
            <th style="text-align: center">
                <h4><strong>Username</strong></h4>
            </th>
            <th style="text-align: center">
                <h4><strong>Role</strong></h4>
            </th>
            <th style="text-align: center">
                <h4><strong>Name</strong></h4>
            </th>
            <th style="text-align: center">
                <h4><strong>Email</strong></h4>
            </th>
            <th style="text-align: center">
                <h4><strong>Phone</strong></h4>
            </th>
            <th style="text-align: center">
                <h4><strong>Birthday</strong></h4>
            </th>
            <th style="text-align: center">
                <h4><strong>Gender</strong></h4>
            </th>
            <th style="text-align: center">
                <h4><strong>Action</strong></h4>
            </th>
        </tr>
        <!-- <span class="hidden">{{$idx=1}}</span> -->
        @foreach($users as $user)
        <tr style="text-align : center">
            <td>{{$user->username}}</td>
            <td>{{$user->role}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->phone}}</td>
            <td>{{$user->birthday}}</td>
            <td>{{$user->gender}}</td>
            <td><a href="{{url("edit-member/$user->id")}}" class="btn btn-success">
                    <i class="fa fa-edit" aria-hidden="true"></i>Edit</a>
                <button class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteAlert-{{$user->id}}"> <i class="fa fa-trash" aria-hidden="true"></i>Delete</button>
            </td>
        </tr>

        <!-- {{--Hidden modal delete--}} -->
        <div class="modal fade" id="modalDeleteAlert-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteAlertTitle" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="modal-title" id="modalDeleteAlertTitle">Hapus Akun Pengguna</h3>
                    </div>
                    <div class="modal-body">
                        <h4>Apakah anda yakin ingin menghapus akun <strong>{{$user->username}}</strong> ?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        <a href="{{url("delete-user/$user->id")}}"><button type="button" class="btn btn-primary">Hapus</button></a>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </table>
    {{ $users->links() }}

</div>

<br><br><br>
<br><br><br>
<br><br><br>
<br><br>



@endsection 