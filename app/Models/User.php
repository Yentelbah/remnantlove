<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Uuid\Uuid;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone', 'status','member_id',
        'church_id',
        'church_branch_id',
        'church_role_id', // Ensure this matches the foreign key in the users table
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
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

    public function getKeyType()
    {
        return 'string';
    }

    public function getIncrementing()
    {
        return false;
    }

    protected $appends = [
        'profile_photo_url',
    ];

    public function churchRole()
    {
        return $this->belongsTo(ChurchRole::class, 'church_role_id');
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'assignees', 'user_id', 'task_id');
    }

    public function hasAnyRole($roles)
    {
        if (!$this->churchRole) {
            return false;
        }

        $userRoleId = $this->churchRole->role_id;

        if (is_array($roles)) {
            return in_array($userRoleId, $roles);
        }

        return $userRoleId === $roles;
    }
}
