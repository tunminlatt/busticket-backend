@extends('adminlte::page')

@section('title', 'Add Booking')

@section('content_header')
    <h1>Add Booking</h1>
@stop

@section('content')

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="bus_id">Bus</label>
            <select name="bus_id" id="bus_id" class="form-control" required>
              <option selected disabled>Select Bus</option>
              @foreach ($buses as $bus)
                  <option value="{{ $bus->id }}">{{ $bus->name }}</option>
              @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="to">Seat</label>
            <select name="seat_ids[]" id="seat_ids" class="form-control" multiple required>
              <option selected disabled>Select Seat</option>
              @foreach ($seats as $seat)
                  <option value="{{ $seat->id }}">[{{ $seat->seatingPlan->bus->name }}] {{ $seat->seat_number }}</option>
              @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="passenger_name">Passenger Name</label>
            <input type="text" name="passenger_name" id="passenger_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="passenger_email">Passenger Email</label>
            <input type="email" name="passenger_email" id="passenger_email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="passenger_phone">Passenger Phone</label>
            <input type="text" name="passenger_phone" id="passenger_phone" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-default" onclick="history.back()">Back</button>
    </form>
@endsection
