<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\SeatID;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::all();
        
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $buses = Bus::all();
        $seats = SeatID::where('is_available', true)->get();

        return view('bookings.create', compact('buses', 'seats'));
    }

    public function store(Request $request)
    {
        $bus = Bus::find($request->bus_id);

        $seats = SeatID::whereIn('id', $request->seat_ids)->get();

        $validatedData = $request->validate([
            'passenger_name' => 'required',
            'passenger_email' => 'required',
            'passenger_phone' => 'required',
            'seat_ids' => 'required'
        ]);

        foreach ($seats as $key => $seat) {

            // Check if the seat is available
            if (!$seat->is_available) {
                return redirect()->back()->with('error', 'Seat is already booked.');
            }
        }

        $booking = new Booking($validatedData);
        $bus->bookings()->save($booking);

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
