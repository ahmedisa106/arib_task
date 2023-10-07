<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $table = 'admins';
    protected $guarded = [];

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
     * @return HasMany
     */
    public function managers(): HasMany
    {
        return $this->hasMany(Manager::class);
    }// end of managers function

    /**
     * @return HasMany
     */
    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }// end of departments function

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
