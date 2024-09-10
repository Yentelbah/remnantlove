<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    use HasFactory;

    protected $fillable = [
        'convert_id',
        'follow_up_date',
        'method', // 'call', 'visit', 'message'
        'notes',
    ];

    // Relationship with Convert
    public function convert()
    {
        return $this->belongsTo(Convert::class);
    }
}
