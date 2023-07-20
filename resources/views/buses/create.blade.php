@extends('adminlte::page')

@section('title', 'Add Bus')

@section('content_header')
    <h1>Add Bus</h1>
@stop

@section('content')

    <form action="{{ route('buses.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="model">Model</label>
            <input type="text" name="model" id="model" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="seating_capacity">Seating Capacity</label>
            <input type="number" name="seating_capacity" id="seating_capacity" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="from">From</label>
            <select name="from" id="from" class="form-control" required>
              <option selected disabled>Select destination</option>
              @foreach ($destinations as $destination)
                  <option value="{{ $destination->id }}">{{ $destination->name }}</option>
              @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="to">To</label>
            <select name="to" id="to" class="form-control" required>
              <option selected disabled>Select destination</option>
              @foreach ($destinations as $destination)
                  <option value="{{ $destination->id }}">{{ $destination->name }}</option>
              @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
