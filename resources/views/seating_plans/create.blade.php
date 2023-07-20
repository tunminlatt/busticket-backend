@extends('adminlte::page')

@section('title', 'Add Seating Plan')

@section('content_header')
    <h1>Add Seating Plan for Bus: {{ $bus->name }}</h1>
@stop

@section('content')

    <form action="{{ route('buses.seating-plans.store', $bus) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="row">Row</label>
            <input type="number"  min=1 name="row" id="row" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="column">Column</label>
            <input type="number" min=1 max=6 name="column" id="column" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-default" onclick="history.back()">Back</button>
    </form>
@endsection
