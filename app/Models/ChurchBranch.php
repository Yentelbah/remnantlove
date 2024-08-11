<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

use function PHPSTORM_META\map;

class ChurchBranch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'city',
        'region',
        'country',
        'phone',
        'phone2',
        'status',
        'church_id',
        'pastor_id'
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

    public function church()
    {
        return $this->belongsTo(Church::class);
    }

    public function pastor()
    {
        return $this->belongsTo(Pastor::class);
    }

    public function members()
    {
        return $this->hasMany(Member::class, 'church_branch_id');
    }

}
