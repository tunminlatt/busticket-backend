@extends('adminlte::page')

@section('title', 'Bus List')

@section('content_header')
    <h1>Bus List</h1>
@stop

@section('content')

    <a href="{{ route('buses.create') }}" class="btn btn-primary mb-2">Add Bus</a>

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
                  <th>Name</th>
                  <th>Model</th>
                  <th>Seating Capacity</th>
                  <th>Destination From</th>
                  <th>Destination To</th>
                  <th>Actions</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($buses as $bus)
                  <tr>
                      <td>{{ $bus->id }}</td>
                      <td>{{ $bus->name }}</td>
                      <td>{{ $bus->model }}</td>
                      <td>{{ $bus->seating_capacity }}</td>
                      <td>{{ $bus->fromDestination->name }}</td>
                      <td>{{ $bus->toDestination->name }}</td>
                      <td>
                          @if($bus->seatingPlan)
                            <a href="{{ route('seating-plans.show', $bus->seatingPlan) }}" class="btn btn-info">View Seating Plan</a>
                          @endif
                          @if($bus->price)
                            <a href="{{ route('prices.edit', $bus->price) }}" class="btn btn-warning">Update Price</a>
                          @else
                            <a href="{{ route('buses.prices.create', $bus) }}" class="btn btn-warning">Set Price</a>
                          @endif
                          @if($bus->seatingPlan)
                            <a href="{{ route('seating-plans.edit', $bus->seatingPlan) }}" class="btn btn-default">Update Seating Plan</a>
                          @else
                            <a href="{{ route('buses.seating-plans.create', $bus) }}" class="btn btn-default">Set Seating Plan</a>
                          @endif
                          <a href="{{ route('buses.edit', $bus) }}" class="btn btn-primary">Edit</a>
                          <form action="{{ route('buses.destroy', $bus) }}" method="POST" class="d-inline">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this bus?')">Delete</button>
                          </form>
                      </td>
                  </tr>
              @endforeach
          </tbody>
      </table>
    </div>
@endsection
