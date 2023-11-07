<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'photos' => 'array'
    ];

    // Relationships

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(
            related: ProductTag::class,
            table: 'product_product_tag'
        );
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(ProductGender::class, 'gender_id');
    }

    //

    public function getPrice(): int
    {
        return $this->off_price ?? $this->price;
    }
}
