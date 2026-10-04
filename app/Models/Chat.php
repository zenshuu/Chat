<?php

namespace App\Models;

use Database\Factories\ChatFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    /** @use HasFactory<ChatFactory> */
    use HasFactory;

    /**
     * The avatar used when a chat has no authenticated user.
     */
    public const DEFAULT_AVATAR_URL = 'https://avatars.laravel.cloud/anonymous?vibe=stealth';

    protected $fillable = ['message'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the avatar of the chat author, falling back to the default avatar.
     */
    protected function avatarUrl(): Attribute
    {
        return Attribute::get(fn (): string => $this->user?->avatar_url ?? self::DEFAULT_AVATAR_URL);
    }
}
