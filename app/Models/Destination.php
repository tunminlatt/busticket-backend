<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'is_available'];

    protected $casts = [
        'is_available' => 'boolean',
    ];

    // Relationship with buses table (from destinations)
    public function fromBuses()
    {
        return $this->hasMany(Bus::class, 'from');
    }

    // Relationship with buses table (to destinations)
    public function toBuses()
    {
        return $this->hasMany(Bus::class, 'to');
    }
}
