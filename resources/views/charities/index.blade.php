@extends('layouts.app')

<div class="container">
    <div class="row justify-content-center">
                @if( auth()->check() )
                    Welcome {{ auth()->user()->name }}, {{ auth()->user()->id  }}
                @endif
                @section('content')
                    @foreach($charities as $charity)
                        <div class="col-12 mb-3">
                            <div class="card">
                                <div class="card-block">
                                    <h3 class="card-title"><a href="/charities/{{ $charity->id }}">{{ $charity->name }}</a></h3>
                                    <p class="card-text">Created from {{ $charity->location }}</p>
                                    <p class="small">Started on {{ $charity->start_date }} </p>
                                    <p class="small">Goal to raise {{ $charity->goal }} before {{ $charity->end_date }}</p>
                                    <p class="small"> Raised {{ $charity->pledged }} so far from {{ $charity->donors }} donors!</p>
                                    <a href="/charities/{{ $charity->id }}" class="btn btn-primary"> Donate</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                @endsection
    </div>
</div>
