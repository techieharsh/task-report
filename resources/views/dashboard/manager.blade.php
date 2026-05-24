@extends('layouts.app')

@section('content')

<div class="row">

    <div class="col-md-4">
        <div class="card p-4">
            <h3>{{ $projects }}</h3>
            <p>Total Projects</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-4">
            <h3>{{ $tasks }}</h3>
            <p>Total Tasks</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-4">
            <h3>{{ $completed }}</h3>
            <p>Completed Tasks</p>
        </div>
    </div>

</div>

@endsection