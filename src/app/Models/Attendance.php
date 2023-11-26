<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'clocked_in_at',
        'clocked_out_at',
        'started_break_at',
        'break_time'
    ];

    protected $attributes = [
        'clocked_out_at' => null,
        'started_break_at' => null,
        'break_time' => 0,
    ];

    protected $dates = [
        'clocked_in_at',
        'clocked_out_at',
        'started_break_at'
    ];

    public function getClockedInAtStrAttribute(): String
    {
        return ($this->clocked_in_at)->toTimeString();
    }

    public function getClockedOutAtStrAttribute(): ?String
    {
        if ($this->clocked_out_at == null) {
            return null;
        } else if ($this->clocked_out_at->isSameDay($this->clocked_in_at)) {
            return $this->clocked_out_at->toTimeString();
        } else {
            return '24:00:00';
        }
    }

    public function getBreakTimeStrAttribute(): String
    {
        return gmdate('H:i:s', $this->break_time);
    }

    public function getWorkTimeStrAttribute(): ?String
    {
        if ($this->clocked_out_at == null) {
            return null;
        } else {
            return gmdate('H:i:s', strtotime($this->clocked_out_at) - strtotime($this->clocked_in_at));
        }
    }
}
