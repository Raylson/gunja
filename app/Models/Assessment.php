<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function examiner() {
        return $this->belongsTo(Examiner::class, 'unique_key', 'unique_key');
    }

    public function question() {
        return $this->belongsTo(Question::class);
    }

    public function answers() {
        return $this->belongsTo(QuestionAnswer::class, 'answer_id');
    }

    public function admin() {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
