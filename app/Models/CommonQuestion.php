<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommonQuestion extends Model
{
    use HasFactory;

    protected $guarded = [];

    const STATUS = [
        'visible',
        'invisible'
    ];

    // Relationships
    public function category(): BelongsTo
    {
        return $this->belongsTo(CommonQuestionCategory::class, 'common_question_category_id');
    }

    // Scopes
    public function scopeStatus($query, $status = 'visible')
    {
        return $query->where('status', $status);
    }
}
