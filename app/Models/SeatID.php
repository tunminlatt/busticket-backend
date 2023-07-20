<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatID extends Model
{
    use HasFactory;

    protected $table = 'seat_ids';

    protected $fillable = ['seating_plan_id', 'seat_number', 'is_available'];

    protected $casts = [
        'is_available' => 'boolean',
    ];

    // Relationship with the SeatingPlan model
    public function seatingPlan()
    {
        return $this->belongsTo(SeatingPlan::class);
    }
}
