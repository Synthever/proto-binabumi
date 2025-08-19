<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    protected $table = 'users_connections';
    
    protected $fillable = [
        'user_id',
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

    // Relationship with Users model
    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id', 'user_id');
    }
}