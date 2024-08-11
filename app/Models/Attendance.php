<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['service_id', 'church_id', 'children_males', 'children_females', 'adult_males', 'adult_females', 'total_attendance', 'church_branch_id'];

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


    public function service()
    {
        return $this->belongsTo(ChurchService::class);
    }


    public static function getLastAttendanceByCategory($category)
    {
        $user = Auth()->user();
        $role = $user->churchRole->role->name;;

        // if ($role === "Church_admin") {
        //     return self::whereHas('service', function($query) use ($category) {
        //         $query->where('category', $category);
        //     })->where('church_id', $user->church_id)->orderBy('created_at', 'desc')->first();

        // }elseif ($role === "Branch_admin") {
            return self::whereHas('service', function($query) use ($category) {
                $query->where('category', $category);
            })->where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->orderBy('created_at', 'desc')->first();
        // }

    }

    public static function getPreviousAttendanceByCategory($category, $lastAttendanceCreatedAt)
    {
        $user = Auth()->user();
        $role = $user->churchRole->role->name;;

        // if ($role === "Church_admin") {

        // }elseif ($role === "Branch_admin") {

        // }

        // if ($role === "Church_admin") {

        //     return self::whereHas('service', function($query) use ($category) {
        //         $query->where('category', $category);
        //     })->where('church_id', $user->church_id)->where('created_at', '<', $lastAttendanceCreatedAt)->orderBy('created_at', 'desc')->first();

        // }elseif ($role === "Branch_admin") {

            return self::whereHas('service', function($query) use ($category) {
                $query->where('category', $category);
            })->where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->where('created_at', '<', $lastAttendanceCreatedAt)->orderBy('created_at', 'desc')->first();

        // }

    }

    public static function getTotalAttendanceByCategory($category)
    {
        $user = Auth()->user();
        $role = $user->churchRole->role->name;;

        // if ($role === "Church_admin") {
        //     return self::whereHas('service', function($query) use ($category) {
        //         $query->where('category', $category);
        //     })->where('church_id', $user->church_id)->sum('total_attendance');

        // }elseif ($role === "Branch_admin") {
            return self::whereHas('service', function($query) use ($category) {
                $query->where('category', $category);
            })->where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->sum('total_attendance');

        // }
    }

    public static function getLastFiveAttendancesByCategory($category)
    {
        $user = Auth()->user();
        $role = $user->churchRole->role->name;;

        // if ($role === "Church_admin") {
        //     return self::whereHas('service', function($query) use ($category) {
        //         $query->where('category', $category);
        //     })->where('church_id', $user->church_id)->orderBy('created_at', 'desc')->take(5)->get();

        // }elseif ($role === "Branch_admin") {
            return self::whereHas('service', function($query) use ($category) {
                $query->where('category', $category);
            })->where('church_id', $user->church_id)->where('church_branch_id', $user->church_branch_id)->orderBy('created_at', 'desc')->take(5)->get();

        // }

    }

}
