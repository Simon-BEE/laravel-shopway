<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = ['id'];

    public function getContentAttribute(string $content)
    {
        return unserialize($content);
    }

    /**
     * ? SCOPES
     */

    public function scopeFindByUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * ? RELATIONS
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
