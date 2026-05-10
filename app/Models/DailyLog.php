<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyLog extends Model
{
    protected $fillable = [
        'user_id',
        'ojt_profile_id',
        'day_no',
        'log_date',
        'location',
        'department_unit',
        'daily_activity',
        'knowledge_skill',
        'tools_technology',
        'issue_challenge_type',
        'issue_challenge',
        'issue_challenge_image_path',
        'flowchart_steps',
        'reflection_solution',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ojtProfile()
    {
        return $this->belongsTo(OjtProfile::class);
    }
}
