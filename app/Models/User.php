<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Obtiene las compras del usuario
     */
    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public const VALIDATION_RULES = [
        'name'                  => 'required|min:2',
        'email'                 => 'required|email',
        'password'              => 'required|min:2|confirmed',
        'password_confirmation' => 'required'
    ];

    public const VALIDATION_MESSAGES = [
        'name.required'                  => 'El nombre no puede estar vacío.',
        'name.min'                       => 'El nombre debe tener al menos :min caracteres.',
        'email.required'                 => 'El email no puede estar vacío.',
        'email.email'                    => 'Email debe tener el formato correcto.',
        'password.required'              => 'La contraseña no puede estar vacía.',
        'password.min'                   => 'El nombre debe tener al menos :min caracteres.',
        'password.confirmed'             => 'Las contraseñas no coinciden.',
        'password_confirmation.required' => 'Debe confirmar la contraseña.',
    ];

    public const CHANGE_PASSWORD_VALIDATION = [
        'old_password'          => 'required',
        'password'              => 'required|min:2|confirmed',
        'password_confirmation' => 'required'
    ];

    public const CHANGE_PASSWORD_MESSEGES = [
        'old_password.required'          => 'La contraseña actual no puede estar vacía.',
        'password.min'                   => 'La nueva contraseña debe tener al menos dos caracteres.',
        'password.required'              => 'La nueva contraseña actual no puede estar vacía.',
        'password.confirmed'             => 'Las contraseñas no coinciden.',
        'password_confirmation.required' => 'Debe confirmar la contraseña.',
    ];
}
