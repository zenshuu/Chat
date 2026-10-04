<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The avatar vibes available on avatars.laravel.cloud.
     *
     * @var list<string>
     */
    public const AVATAR_VIBES = ['sunset', 'ocean', 'daybreak', 'bubble', 'forest', 'fire', 'crystal', 'ice', 'stealth'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    /**
     * Get the avatar served by avatars.laravel.cloud, with a vibe picked from the user key.
     */
    protected function avatarUrl(): Attribute
    {
        return Attribute::get(function (): string {
            $vibes = self::AVATAR_VIBES;
            $vibe = $vibes[abs(crc32((string) $this->getKey())) % count($vibes)];

            return "https://avatars.laravel.cloud/{$this->getKey()}?vibe={$vibe}";
        });
    }
}
