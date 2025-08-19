<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $table = 'users_statistics';
    
    protected $fillable = [
        'user_id',
        'balance',
        'poin',
        'bottle_count',
        'date_created',
        'date_updated',
    ];

    // Disable Laravel's automatic timestamps since we're using custom date fields
    public $timestamps = false;

    // Define relationship with Users model
    public function user()
    {
        return $this->belongsTo(\App\Models\Users::class, 'user_id', 'user_id');
    }
}
