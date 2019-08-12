@extends('layouts.app')

@section('content')
    <div class="card" style="width: 270px;margin: 5px">
        <div class="card-block">
            <h3 class="card-title">{{ $charity->name }}</h3>
            <p class="card-text">{{ $charity->name }} is launched to accept donations</p>
            <p class="card-text">This charity has raised {{ $charity->pledged }} of {{ $charity->goal }} from {{ $charity->donors }} donors</p>
            <a href="/charities" class="btn btn-primary">List Charities</a>
        </div>
    </div>

    <hr>

    <h2>Donate to charity {{ $charity->id }} </h2>

    @if(Session::has('message'))
        <div class="alert alert-info">
            {{ Session::get('message') }}
        </div>
    @endif

    <form method="post" action="/donation" enctype="multipart/form-data">
        <input id="user_id" name="user_id" type="hidden" value={{ \Illuminate\Support\Facades\Auth::id() }}>
        <input id="charity_id" name="charity_id" type="hidden" value={{ $charity->id  }}>
        <input id="is_view" name="is_view" type="hidden" value={{ true }}>

        {{ csrf_field() }}
        <div class="form-group row">
            <label for="amount" class="col-sm-3 col-form-label">donation amount</label>
            <div class="col-sm-9">
                <input name="amount" type="number" min="0" step="any" class="form-control" id="amount" placeholder="donation amount" required>
            </div>
        </div>
        <br><br>
        Enter your Billing Information
        <br>
        <div class="form-group row">
            <label for="street" class="col-sm-3 col-form-label">Street Name</label>
            <div class="col-sm-9">
                <input name="street" type="text" class="form-control" id="street"
                       placeholder="123 Main Street" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="city" class="col-sm-3 col-form-label">City</label>
            <div class="col-sm-9">
                <input name="city" type="text" class="form-control" id="city"
                       placeholder="Albany" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="state" class="col-sm-3 col-form-label">State</label>
            <div class="col-sm-9">
                <input name="state" type="text" class="form-control" id="state"
                       placeholder="New York" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="country" class="col-sm-3 col-form-label">Country</label>
            <div class="col-sm-9">
                <input name="country" type="text" class="form-control" id="country"
                       placeholder="USA" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="zip" class="col-sm-3 col-form-label">Zipcode</label>
            <div class="col-sm-9">
                <input name="zip" type="text" class="form-control" id="zip"
                       placeholder="12345" required>
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-sm-3 col-sm-9">
                <button type="submit" class="btn btn-primary">Submit Donation</button>
            </div>
        </div>
    </form>


@endsection
