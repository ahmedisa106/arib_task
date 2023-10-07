<?php

namespace App\Models;

use Dflydev\DotAccessData\Data;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Manager extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $table = 'managers';
    protected $guarded = [];

    protected $hidden = ['password'];


    /**
     * @return HasMany
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }// end of tasks function

    /**
     * @return HasManyThrough
     */
    public function employees(): HasManyThrough
    {
        return $this->hasManyThrough(Employee::class, Department::class, 'manager_id', 'department_id');
    }// end of employees function

    /**
     * @return HasMany
     */
    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }// end of department function

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
        return $this->tasks()->where('manager_id', auth('manager')->id())->where('status', 'pending')->count();
    }// end of pendingTasks function

    /**
     * @return int
     */
    public function doneTasksCount(): int
    {
        return $this->tasks()->where('manager_id', auth('manager')->id())->where('status', 'done')->count();
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
