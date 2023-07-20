@extends('adminlte::page')

@section('title', 'View Seating Plan')

@section('content_header')
    <h1>View Seating Plan for Bus: {{ $seatingPlan->bus->name }}</h1>
@stop

@section('content')
    <span class="badge badge-success mb-2">Available</span>
    <span class="badge badge-danger mb-3">Booked</span>
    <div class="card-body">
        @php
            $rows = $seatingPlan->row;
            $columns = $seatingPlan->column;
            $seatChunks = $seatingPlan->seats->chunk($columns);
        @endphp

        @foreach ($seatChunks as $row)
            <div class="row">
                @foreach ($row as $seat)
                <div class="col col-md-{{ 12/$columns }}">
                    <div class="card">
                    <div class="card-body {{ $seat->is_available ? 'bg-green' : 'bg-red' }}">
                        <h5 class="card-title">{{ $seat->seat_number }}</h5>
                    </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endforeach

        <button type="button" class="btn btn-default" onclick="history.back()">Back</button>
    </div>
@endsection

@section('css')
<style>
    .card {
      margin-bottom: 10px;
    }
</style>
@stop
