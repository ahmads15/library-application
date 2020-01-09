@extends('layouts.app')
@section('content')
<div class="container">
    <br><br>
    <br>
    @include('layouts.partials.alerts')
    <h2 style="text-align:center"> <i class="fa fa-book" aria-hidden="true"></i> Manage Transactions</h2>
    <div class="row">
        <div class="col-md-12" style="margin: 25px">
            <form action="{{url('transaction-search')}}" method="POST">
                {{csrf_field()}}
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by Borrow Status">
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
    <br>
    <table class="table">
        <tr>
            <th style="text-align: center">
                <h4><strong>Lend Start Date</strong></h4>
            </th>
            <th style="text-align: center">
                <h4><strong>Lend Due Date</strong></h4>
            </th>
            <th style="text-align: center">
                <h4><strong>Status</strong></h4>
            </th>
            <th style="text-align: center">
                <h4><strong>Borrower Name</strong></h4>
            </th>
            <th style="text-align: center" colspan="3">
                <h4><strong>Action</strong></h4>
            </th>
        </tr>
        @foreach($transactions as $t)
            <tr style="text-align : center">
                <td>{{$t->lend_start}}</td>
                <td>{{$t->lend_due}}</td>
                <td>{{$t->status}}</td>
                <td>{{$t->name}}</td>
                <td>
                    <form action="{{url('return-book/'.$t->id)}}" method="POST">
                        {{csrf_field()}}
                        <button class="btn btn-success" {{$t->status != 'Waiting for Approval' ? 'disabled' : ''}}><i class="fa fa-check"></i> Process</button>
                    </form>
                </td>
                <td>
                    <a href="{{url('borrow-history')}}" class="btn btn-primary"><i class="fa fa-eye"></i> View Detail</button>
                </td>
                <td>
                    <a href="{{url("delete-transaction/$t->id")}}"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i>Delete</button></a>
                </td>
            </tr>
        @endforeach
    </table>
</div>

<br><br><br>
<br><br><br>
<br><br><br>
<br><br>



@endsection 