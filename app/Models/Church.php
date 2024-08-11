<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Church extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'churchID',
        'address',
        'city',
        'region',
        'country',
        'phone',
        'phone2',
        'email',
        'photo',
        'agreed_to_terms','updated_profile'
    ];

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

    public function branches()
    {
        return $this->hasMany(ChurchBranch::class);
    }

    public function settings()
    {
        return $this->belongsTo(Setting::class);
    }


}
