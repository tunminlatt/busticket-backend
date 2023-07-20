@extends('adminlte::page')

@section('title', 'Edit Price')

@section('content_header')
    <h1>Edit Price for bus: {{ $price->bus->name }}</h1>
@stop

@section('content')

    <form action="{{ route('prices.update', $price) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" name="amount" id="amount" class="form-control" value="{{ $price->amount }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-default" onclick="history.back()">Back</button>
    </form>
@endsection
