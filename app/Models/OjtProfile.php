<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OjtProfile extends Model
{
    protected $fillable = [
        'user_id',
        'company_name',
        'department',
        'start_date',
        'end_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dailyLogs()
    {
        return $this->hasMany(DailyLog::class);
    }
}
