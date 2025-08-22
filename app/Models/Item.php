<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'barcode',
        'rfid',
        'location_id',
        'collection_type_id',
        'status',
        'condition',
        'acquisition_date',
        'price',
        'source',
        'notes',
        'is_available'
    ];

    protected $casts = [
        'acquisition_date' => 'date',
        'is_available' => 'boolean',
    ];

    // Relationships
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function collectionType(): BelongsTo
    {
        return $this->belongsTo(CollectionType::class);
    }

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
}
