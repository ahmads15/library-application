@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="margin-top: 10%">
        <!-- <div class="col-md-8 col-md-offset-2">
                {{--<div class="book-detail" style="margin-top: 10%">--}}
                    {{--<div class="col-md-12" style="padding-top: 10px; padding-bottom: 10px; border: 1px solid #ddd">--}}
                        {{--<div style="width: 80%; float: left"><h4><b>{{$book->name}}</b></h4></div>--}}
                        {{--<div style="width: 20%; float: left; text-align: right">{{$book->category}}</div>--}}
                    {{--</div>--}}

                    {{--<div class="col-md-12" style="padding-top: 10px; padding-bottom: 10px; border: 1px solid #ddd">--}}
                        {{--{{$book->description}}--}}
                    {{--</div>--}}

                    {{--<div class="col-md-12" style="padding-top: 10px; padding-bottom: 10px; border: 1px solid #ddd">--}}
                        {{--<div style="text-align: center; float: left; width: 50%; border-right: 1px solid #ddd">Stock in Library : {{$book->stock}} book(s)</div>--}}
                        {{--<div style="text-align: center; float: left; width: 50%">Location : {{$book->location}}</div>--}}
                    {{--</div>--  
                    
                        }}
                {{--</div>--}} -->

        <!-- VIEW DETAIL BOOK -->
        @include('layouts.partials.alerts')
        <table class="table table-bordered" >
            <tr>
                <td colspan="3" style="text-align: right">
                    <span style="float: left">{{$book->name}}</span>
                    {{$book->category}}
                </td>
            </tr>
            <tr>
                <td colspan="3">{{$book->description}}</td>
            </tr>
            <tr>
                <td style="text-align: center; width:33%">Stock in Library : {{$book->stock}} book(s)</td>
                <td style="text-align: center;width:33%">Location : {{$book->location}}</td>
                @if( !Auth::guest() && (Auth::user()->role)=='member')
                <td style="text-align: center"> 
                    <a href="{{url('borrow-book/'.$book->id)}}">Borrow</a>
                </td>
                @endif
            </tr>
        </table>
    </div>
</div>
</div>
@endsection 