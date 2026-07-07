<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'text', 'user_id', 'category_id', 'image', 'alt_image'];

    /**
     * Crea la relación con el usuario
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Crea la relación con la categoría
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class);
    }

    /**
     * Crea la relación con los tags
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(BlogTag::class, table: 'tags_blogs', foreignPivotKey: 'blog_id', relatedPivotKey: 'tag_id');
    }

    /**
     * Retorna un texto recortado pro la cantidad de palabras solicitadas
     * @param int $maxWords
     * @return string
     */
    public function shortDescription(int $maxWords): string
    {
        $words = explode(' ', $this->text);
        if (count($words) <= $maxWords) {
            return $this->text;
        }
        $shortText = array_slice($words, 0, $maxWords);
        return implode(' ', $shortText) . '...'; // Agregamos puntos suspensivos al final
    }

    public const VALIDATION_RULES = [
        'title'       => 'required|min:2',
        'text'        => 'required|min:5',
        'category_id' => 'required|numeric|exists:blog_categories,id',
        'tags.*'      => 'exists:blog_tags,id'
    ];

    public const VALIDATION_MESSAGES = [
        'title.required'       => 'El título no puede estar vacío.',
        'title.min'            => 'El título debe tener al menos :min caracteres.',
        'text.min'             => 'El text debe tener al menos :min caracteres.',
        'text.required'        => 'El texto no puede estar vacío.',
        'category_id.numeric'  => 'Categoría inválida.',
        'category_id.exists'   => 'Categoría inválida.',
        'category_id.required' => 'La categoría debe tener un valor.',
    ];
}
