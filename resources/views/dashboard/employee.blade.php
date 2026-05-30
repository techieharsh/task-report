@extends('layouts.app')

@section('content')

<h3>My Tasks</h3>

<table class="table table-bordered">

    <thead>
        <tr>
            <th>Title</th>
            <th>Status</th>
            <th>Deadline</th>
        </tr>
    </thead>

    <tbody>

        @foreach($tasks as $task)
        <tr>
            <td>{{ $task->title }}</td>
            <td>{{ $task->status }}</td>
            <td>{{ $task->deadline }}</td>
        </tr>
        @endforeach

    </tbody>

</table>

@endsection
