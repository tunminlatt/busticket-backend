<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = ['bus_id', 'amount'];

    protected $hidden = ['created_at', 'updated_at'];

    // Relationship with the Bus model
    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }
}
