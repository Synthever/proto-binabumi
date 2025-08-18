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
        'is_connect',
        'machine_id',
        'date_created',
        'date_updated',
    ];

    protected $casts = [
        'is_connect' => 'boolean',
    ];

    // Disable Laravel's automatic timestamps since we're using custom date fields
    public $timestamps = false;
}
