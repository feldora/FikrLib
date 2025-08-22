<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'statement_of_responsibility',
        'edition',
        'isbn',
        'issn',
        'publisher_id',
        'place_id',
        'publish_year',
        'pages',
        'series_title',
        'call_number',
        'language_code',
        'source'
    ];

    // Relationships
    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(BookReview::class);
    }
}
