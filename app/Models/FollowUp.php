<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class FollowUp extends Model
{
    protected static function boot()
    {
        parent::boot();

        // Generate a UUID for the user.
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Uuid::uuid4()->toString();
            }
        });
    }

      /**
     * Get the key type.
     *
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

    protected $fillable = [
        'contact_id',
        'follow_up_date',
        'method', // 'call', 'visit', 'message'
        'notes',
        'follow_up_date', 'contact_type', 'status', 'message', 'church_id', 'church_branch_id'
    ];

    // Relationship with Convert
    public function convert()
    {
        return $this->belongsTo(Convert::class);
    }
}
