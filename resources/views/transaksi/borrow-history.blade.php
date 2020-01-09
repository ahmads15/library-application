@extends('layouts.app')

@section('content')
<div class="container" style="height: 100vh;">


    <br><br>
    <div class="row">

        <div class="col-md-12">

            <div class="col-md-8 col-md-offset-2">
                <div class="book">
                    <div class="book-content">
                    @if(count($transactions) > 0)
                        <?php 
                            $date1 = date('l, d M Y', strtotime($transactions[0]->lend_start));
                            $date2 = date('H:i:s', strtotime($transactions[0]->lend_start));
                        ?>
                        <table class="table table-border">
                            <tr>
                                <td>{{$date1}} at {{$date2}}</td>
                                <td>
                                    @if($transactions[0]->status != 'Completed' && Auth::user()->role == 'admin')
                                        Waiting for Return
                                    @else
                                        {{$transactions[0]->status}}
                                    @endif    
                                </td>
                            </tr>
                            @foreach($transactions as $t)
                            <tr>
                                <td>{{$t->name}}</td>
                                <td>
                                    @if($t->status == 'Waiting for Approval' && Auth::user()->role == 'member')
                                        On Lending at {{$t->lend_start}}
                                    @elseif($t->status == 'Waiting for Approval' && Auth::user()->role == 'admin')
                                        <form action="{{url('return-book/'.$t->id)}}" method="POST">
                                            {{csrf_field()}}
                                            <button class="btn btn-info"><i class="fa fa-reply"></i> Return</button>
                                        </form>
                                    @else
                                        Returned at {{$t->lend_start}}
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    @endif
                    
                </div>
            </div>
        </div>



    </div>
    @endsection 