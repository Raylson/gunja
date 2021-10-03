<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subCategory() {
        return $this->belongsTo(SubCategory::class);
    }

    public function answers() {
        return $this->hasMany(\App\Models\QuestionAnswer::class, 'question_id');
    }
}
