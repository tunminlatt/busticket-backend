<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'model', 'seating_capacity', 'from', 'to'];

    public function seatingPlan()
    {
        return $this->hasOne(SeatingPlan::class);
    }

    public function price()
    {
        return $this->hasOne(Price::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function fromDestination()
    {
        return $this->belongsTo(Destination::class, 'from');
    }

    public function toDestination()
    {
        return $this->belongsTo(Destination::class, 'to');
    }
}
