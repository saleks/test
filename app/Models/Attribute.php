<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = [
        'name', 'type', 'symbol'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function productTypes()
    {
        return $this->belongsToMany(ProductType::class, 'product_type_attribute');
    }
}
