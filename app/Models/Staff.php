<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'position',
        'church_id', 'education_background',
        'hobbies_interests',
        'health_status',
        'date_appointed', 'church_branch_id', 'user_id'
    ];
        /**
     * Boot function from Laravel.
     */
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

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
