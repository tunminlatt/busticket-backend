@extends('adminlte::page')

@section('title', 'Add Price')

@section('content_header')
    <h1>Add Price for Bus: {{ $bus->name }}</h1>
@stop

@section('content')

    <form action="{{ route('buses.prices.store', $bus) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" name="amount" id="amount" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-default" onclick="history.back()">Back</button>
    </form>
@endsection
