<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CommonQuestionCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    const STATUS = [
        'active',
        'inactive'
    ];

    // Relationships
    public function commonQuestions(): HasMany
    {
        return $this->hasMany(CommonQuestion::class, 'common_question_category_id');
    }

    // Scopes
    public function scopeStatus($query, $status = 'active')
    {
        return $query->where('status', $status);
    }
}
