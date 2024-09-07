<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    const STATUS = [
        'active',
        'inactive'
    ];

    // Relations 
    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class, 'blog_category_id');
    }

    // Scopes
    public function statusScope($query, $status = 'active')
    {
        return $query->where('status', $status);
    }
}
