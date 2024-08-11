<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class ChurchRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'church_id',
        'role_id',
        'name','church_branch_id',
        'description',
        'additional_permissions',
    ];

    protected static function boot()
    {
        parent::boot();

        // Generate a UUID for the church role.
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Uuid::uuid4()->toString();
            }
        });
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function getIncrementing()
    {
        return false;
    }

    public function church()
    {
        return $this->belongsTo(Church::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

}
