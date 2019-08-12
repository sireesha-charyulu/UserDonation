@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                Welcome to DonateMagic.

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if( auth()->check() )

                            <a class="nav-link" href="#">Hello {{ auth()->user()->name }}, your user_id is : {{ auth()->user()->id  }}</a>

                    @endif
                </div>
        </div>
    </div>
</div>
@endsection
