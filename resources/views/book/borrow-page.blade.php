@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    <!-- VIEW BORROW HISTORY -->
    <table class="table table-bordered" style="margin-top: 10%">
            <tr>
                <td colspan="3" style="text-align: right">
                    <span style="float: left">{{$transaction->created_at}}</span>
                    {{$transaction->status}}
                </td>
            </tr>
            <tr>
                <td style="text-align: center"> {{$transaction->book_id}}</td>
                <td style="text-align: center">On leanding at {{$transaction->created_at}}</td>
            </tr>
        </table>
  

    </div>
</div>
</div>
@endsection 