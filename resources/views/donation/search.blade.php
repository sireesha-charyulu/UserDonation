@extends('layouts.app')
@section('css')
    <style>
        a, a:hover {
            color: white;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <h1 style="font-size: 2.2rem">Donations List </h1>
        <hr/>
        <div class="container">
            @if(session('success'))
                <h1>{{session('success')}}</h1>
            @endif
            <form method="POST" action="{{route('filter.selected-id')}}">
                {{ csrf_field() }}
                <div class="form-group row">
                    <div class="col-sm-8">
                        <select class="form-control" id="selectCharity" name="charity_id" focus>
                            <option value="" disabled selected>select charity</option>
                            @foreach($charities as $charity)
                                <option value="{{$charity->id}}">{{ $charity->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br><br>
                    <div class="col-sm-8">
                        <select class="form-control" id="selectUser" name="user_id" focus>
                            <option value="" disabled selected>select user</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <input type="submit" value="Filter">
            </form>
                <br>
                @if( isset($charity_id) )
                    Showing results for Charity {{ $charity_id }}
                @endif
                @if( isset($user_id) )
                    Showing results for User {{ $user_id }}
                @endif
                <br><br>
            @include('partials.showFilterResults')

        </div>
@endsection
