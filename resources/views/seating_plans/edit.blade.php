@extends('adminlte::page')

@section('title', 'Edit Seating Plan')

@section('content_header')
    <h1>Edit Seating Plan for Bus: {{ $seatingPlan->bus->name }}</h1>
@stop

@section('content')

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('seating-plans.update', $seatingPlan) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="row">Row</label>
            <input type="number" min=1 name="row" id="row" class="form-control" value="{{ $seatingPlan->row }}" required>
        </div>
        <div class="form-group">
            <label for="column">Column</label>
            <input type="number" min=1 max=6 name="column" id="column" class="form-control" value="{{ $seatingPlan->column }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-default" onclick="history.back()">Back</button>
    </form>
@endsection
