<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Task extends Model
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


    protected $fillable = ['title', 'description', 'category_id', 'status', 'due_date', 'created_by', 'assigned_to', 'progress', 'church_id', 'church_branch_id', 'priority'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignees()
    {
        return $this->belongsToMany(User::class, 'task_assignees', 'task_id', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(TaskComment::class)->orderBy('created_at', 'desc');
    }

    public function notifications()
    {
        return $this->hasMany(TaskNotification::class);
    }

    public function reminders()
    {
        return $this->hasMany(TaskReminder::class);
    }

    public function category()
    {
        return $this->belongsTo(TaskCategory::class);
    }

    public function steps()
    {
        return $this->hasMany(TaskStep::class)->orderBy('level', 'asc');
    }
}
