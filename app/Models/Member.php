<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Member extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        // Generate a UUID for the user.
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Uuid::uuid4()->toString();
            }
        });

        static::creating(function ($member) {
            $prefix = 'MEM';
            $year = date('y');
            $randomNumber = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
            $newSerialId = $prefix . $year . $randomNumber;
            $member->member_number = $newSerialId;
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
        'email',
        'phone',
        'address',
        'location',
        'photo',
        'dob', 'gender',
        'church_id', 'church_branch_id', 'user_id'
    ];


    public function pastor()
    {
        return $this->belongsTo(Pastor::class);
    }

    public function leader()
    {
        return $this->belongsTo(GroupLeader::class);
    }

    public function churchBranch()
    {
        return $this->belongsTo(ChurchBranch::class, 'church_branch_id');
    }


}
