<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id'];

    /**
     * ? ATTRIBUTES
     */

    /**
     * Return the main reference of a product
     *
     * @return Reference (model)
     */
    public function getFirstReferenceAttribute(): Reference
    {
        return $this->references->first();
    }

    /**
     * Return truncate description of a product
     *
     * @return string
     */
    public function getExcerptAttribute(): string
    {
        return substr($this->description, 0, 200) . '...';
    }

    /**
     * ? RELATIONS
     */

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function references()
    {
        return $this->hasMany(Reference::class);
    }
}
