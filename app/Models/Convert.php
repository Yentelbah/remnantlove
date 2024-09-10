<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Convert extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

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
        'name',
        'phone', 'email',
        'evangelism_id', 'gender',
        'location',
        'status', // e.g., 'joined', 'pending', 'not_interested'
        'joined_at',
        'follow_up_status',
        'notes',
        'church_id','church_branch_id'
    ];

    // Relationship with Evangelism event
    public function evangelism()
    {
        return $this->belongsTo(Evangelism::class);
    }

    // Relationship with FoundationSchool
    public function foundationSchool()
    {
        return $this->hasOne(FoundationSchool::class);
    }

    // Relationship with FollowUp
    public function followUps()
    {
        return $this->hasMany(FollowUp::class);
    }
}
