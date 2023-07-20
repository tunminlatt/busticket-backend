@extends('adminlte::page')

@section('title', 'Edit Bus')

@section('content_header')
    <h1>Edit Bus</h1>
@stop

@section('content')

    <form action="{{ route('buses.update', $bus) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $bus->name }}" required>
        </div>
        <div class="form-group">
            <label for="model">Model</label>
            <input type="text" name="model" id="model" class="form-control" value="{{ $bus->model }}" required>
        </div>
        <div class="form-group">
            <label for="seating_capacity">Seating Capacity</label>
            <input type="number" name="seating_capacity" id="seating_capacity" class="form-control" value="{{ $bus->seating_capacity }}" required>
        </div>
        <div class="form-group">
            <label for="from">From</label>
            <select name="from" id="from" class="form-control" required>
              @foreach ($destinations as $destination)
                  <option value="{{ $destination->id }}"
                  @if ($destination->id == $bus->from)
                      selected="selected"
                  @endif
                  >{{ $destination->name }}</option>
              @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="to">To</label>
            <select name="to" id="to" class="form-control" required>
              @foreach ($destinations as $destination)
                  <option value="{{ $destination->id }}"
                  @if ($destination->id == $bus->to)
                      selected="selected"
                  @endif
                  >{{ $destination->name }}</option>
              @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-default" onclick="history.back()">Back</button>
    </form>
@endsection
