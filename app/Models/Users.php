<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';
    
    protected $fillable = [
        'user_id',
        'username',
        'name',
        'no_handphone',
        'email',
        'password',
        'profile_picture',
        'is_login',
        'date_created',
        'date_updated',
    ];

    protected $casts = [
        'is_connect' => 'boolean',
        'is_login' => 'boolean',
    ];

    // Disable Laravel's automatic timestamps since we're using custom date fields
    public $timestamps = false;

    /**
     * Find user by user_id
     * 
     * @param string $userId
     * @return Users|null
     */
    public static function findByUserId($userId)
    {
        return self::where('user_id', $userId)->first();
    }

    /**
     * Find user by user_id or fail
     * 
     * @param string $userId
     * @return Users
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public static function findByUserIdOrFail($userId)
    {
        return self::where('user_id', $userId)->firstOrFail();
    }

    /**
     * Check if user exists by user_id
     * 
     * @param string $userId
     * @return bool
     */
    public static function existsByUserId($userId)
    {
        return self::where('user_id', $userId)->exists();
    }
}


