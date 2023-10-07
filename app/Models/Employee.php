<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Employee extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $table = 'employees';
    protected $guarded = [];
    protected $appends = ['full_name'];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }// end of department function


    /**
     * @return HasMany
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }// end of tasks function

    /**
     * @return Attribute
     */
    public function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->first_name . ' ' . $this->last_name
        );
    }// end of fullName function

    /**
     * @return Attribute
     */
    public function password(): Attribute
    {
        return Attribute::make(
            set: fn($value) => is_null($value) ? $this->password : bcrypt($value)
        );
    }// end of password function


    /**
     * @return int
     */
    public function pendingTasksCount(): int
    {
        return $this->tasks()->where('employee_id', auth('employee')->id())->where('status', 'pending')->count();
    }// end of pendingTasks function

    /**
     * @return int
     */
    public function doneTasksCount(): int
    {
        return $this->tasks()->where('employee_id', auth('employee')->id())->where('status', 'done')->count();
    }// end of pendingTasks function

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
