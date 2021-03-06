<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use DateTimeInterface;

class Examiner extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function assessments() {
        return $this->hasMany(Assessment::class, 'examiner_id');
    }
}
