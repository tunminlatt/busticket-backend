@extends('adminlte::page')

@section('title', 'Booking List')

@section('content_header')
    <h1>Booking List</h1>
@stop

@section('content')

    <a href="{{ route('bookings.create') }}" class="btn btn-primary mb-2">Add Booking</a>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
          <thead>
              <tr>
                  <th>ID</th>
                  <th>Bus</th>
                  <th>Seat Number</th>
                  <th>Passenger Name</th>
                  <th>Passenger Email</th>
                  <th>Passenger Phone</th>
                  <th>Actions</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($bookings as $booking)
                  <tr>
                      <td>{{ $booking->id }}</td>
                      <td>{{ $booking->bus->name }}</td>
                      <td>{{ $booking->seat_numbers }}</td>
                      <td>{{ $booking->passenger_name }}</td>
                      <td>{{ $booking->passenger_email }}</td>
                      <td>{{ $booking->passenger_phone }}</td>
                      <td>
                          <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="d-inline">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this booking?')">Delete</button>
                          </form>
                      </td>
                  </tr>
              @endforeach
          </tbody>
      </table>
    </div>
@endsection
