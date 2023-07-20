<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatingPlan extends Model
{
    use HasFactory;

    protected $fillable = ['bus_id', 'row', 'column'];

    protected $hidden = ['created_at', 'updated_at'];
    

    // Relationship with the Bus model
    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    public function seats()
    {
        return $this->hasMany(SeatID::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($seatingPlan) {
            $seatingPlan->createSeats();
        });

        static::updated(function ($seatingPlan) {
            $seatingPlan->updateSeats();
        });
    }

    public function createSeats()
    {
        $rows = $this->row;
        $columns = $this->column;
        $capacity = 1;

        for ($row = 1; $row <= $rows; $row++) {
            for ($column = 1; $column <= $columns; $column++) {
                if ($this->bus->seating_capacity >= $capacity) {
                    SeatID::create([
                        'seating_plan_id' => $this->id,
                        'seat_number' => $this->getSeatNumber($row, $column),
                        'is_available' => true,
                    ]);
                    $capacity++;
                }
            }
        }
    }

    public function updateSeats()
    {
        $rows = $this->row;
        $columns = $this->column;
        $capacity = 1;

        $seats = $this->seats;

        for ($row = 1; $row <= $rows; $row++) {
            for ($column = 1; $column <= $columns; $column++) {
                if ($this->bus->seating_capacity >= $capacity) {
                    $seat = $seats->where('seat_number', $this->getSeatNumber($row, $column))->first();

                    if (!$seat) {
                        SeatID::create([
                            'seating_plan_id' => $this->id,
                            'seat_number' => $this->getSeatNumber($row, $column),
                            'is_available' => true,
                        ]);
                    }
                    $capacity++;
                }
            }
        }
    }

    public function getSeatNumber($row, $column)
    {
        $alphabet = chr(64 + $row);

        return $alphabet . $column;
    }
}
