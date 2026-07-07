<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = ['total_amount', 'status', 'user_id'];

    protected function totalAmount(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value / 100,
            set: fn($value) => $value * 100
        );
    }

    /**
     * Crea la relación con el usuario
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Crea la relación para ver los juegos comprados del usuario.
     * @return BelongsToMany
     */
    public function games(): BelongsToMany
    {
        return $this->belongsToMany(
            Game::class,
            table: 'purchases_have_games',
            foreignPivotKey: 'purchase_id',
            relatedPivotKey: 'game_id'
        )->withPivot('individual_price', 'quantity');
    }
    public const VALIDATION_RULES = [
        'total_amount' => 'required|min:2',
        'status'       => 'required',
        'user_id'      => 'required|numeric|exists:users,id',
    ];

    public const VALIDATION_MESSAGES = [
        'total_amount.required' => 'El total no puede estar vacío.',
        'total_amount.min'      => 'El total debe tener al menos :min caracteres.',
        'status.required'       => 'El estado no puede estar vacío.',
        'user_id.required'      => 'Debe haber un usuario relacionado.',
    ];
}
