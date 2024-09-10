<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class FoundationSchool extends Model
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
        'convert_id',
        'enrollment_date',
        'graduation_date', // nullable if the convert hasn’t graduated yet
        'status', // 'in_progress', 'completed', 'dropped_out'
        'church_id',
        'church_branch_id'

    ];

    // Relationship with Convert
    public function convert()
    {
        return $this->belongsTo(Convert::class);
    }

    // Relationship with Modules
    public function modules()
    {
        return $this->belongsToMany(FoundationSchoolModule::class)->withPivot('completed_at');
    }
}
