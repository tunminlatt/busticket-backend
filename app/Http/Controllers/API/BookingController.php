<?php

namespace App\Http\Controllers\API;

use App\Models\Bus;
use App\Models\SeatID;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = \Validator::make($request->all(), [
            'passenger_name' => 'required',
            'passenger_email' => 'required',
            'passenger_phone' => 'required',
            'seat_ids' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $bus = Bus::find($request->bus_id);
        $seats = SeatID::whereIn('id', json_decode($request->seat_ids))->get();

        $validatedData = [
            'passenger_name' => $request->passenger_name,
            'passenger_email' => $request->passenger_email,
            'passenger_phone' => $request->passenger_phone,
            'seat_ids' => json_decode($request->seat_ids)
        ];

        foreach ($seats as $key => $seat) {
            // Check if the seat is available
            if (!$seat->is_available) {
                return response()->json(['message' => 'Seat is already booked. [' . $seat->seat_number .']'], 408);
            }
        }

        $booking = new Booking($validatedData);
        $bus->bookings()->save($booking);

        return response()->json(['message' => 'Seat booked successfully.']);
    }
}