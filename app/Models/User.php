<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    const ROL_ADMIN  = 'admin';
    const ROL_EDITOR = 'editor';

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre_completo',
        'email',
        'password',
        'rol',
    ];

    protected $appends = [
        'name',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function esAdmin(): bool
    {
        return $this->rol === self::ROL_ADMIN;
    }

    public function esEditor(): bool
    {
        return $this->rol === self::ROL_EDITOR;
    }

    public function etiquetaRol(): string
    {
        return match ($this->rol) {
            self::ROL_ADMIN  => 'Administrador',
            self::ROL_EDITOR => 'Editor',
            default          => ucfirst($this->rol),
        };
    }

    public function puedeGestionarUsuarios(): bool
    {
        return $this->esAdmin();
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->esAdmin();
    }

    public function getNameAttribute(): string
    {
        return $this->nombre_completo ?? $this->email ?? 'Usuario';
    }

    public function getFilamentName(): string
    {
        return $this->name;
    }
}
