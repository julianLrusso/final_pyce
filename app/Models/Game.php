<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'price', 'release_date', 'image', 'genre_id'];


    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value / 100,
            set: fn($value) => $value * 100
        );
    }

    /**
     * Crea la relación con géneros
     * @return BelongsTo
     */
    public function genre(): BelongsTo
    {
        return $this->belongsTo(GameGenre::class);
    }

    /**
     * Crea la relación para ver las compras del usuario.
     * @return BelongsToMany
     */
    public function purchases(): BelongsToMany
    {
        return $this->belongsToMany(
            Purchase::class,
            table: 'purchases_have_games',
            foreignPivotKey: 'game_id',
            relatedPivotKey: 'purchase_id'
        )->withPivot('individual_price', 'quantity');
    }
}
