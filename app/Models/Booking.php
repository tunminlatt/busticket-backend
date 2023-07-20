<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['bus_id', 'seat_ids', 'passenger_name', 'passenger_email', 'passenger_phone'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($booking) {
            $seatIds = $booking->seat_ids;
            SeatID::whereIn('id', $seatIds)
                ->update(['is_available' => false]);
        });

        static::deleted(function ($booking) {
            $seatIds = $booking->seat_ids;
            SeatID::whereIn('id', $seatIds)
                ->update(['is_available' => true]);
        });
    }

    // Relationship with the Bus model
    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    // Mutator for seat_ids attribute
    public function setSeatIdsAttribute($value)
    {
        $this->attributes['seat_ids'] = json_encode($value);
    }

    // Accessor for seat_ids attribute
    public function getSeatIdsAttribute($value)
    {
        return json_decode($value, true);
    }

    public function getSeatNumbersAttribute()
    {
        $seatIds = $this->seat_ids;

        $seatNumbers = SeatID::whereIn('id', $seatIds)->pluck('seat_number')->toArray();

        return implode(',', $seatNumbers);
    }
}
