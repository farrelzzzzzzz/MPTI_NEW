<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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
            'login_attempts' => 'integer',
            'locked_until' => 'datetime',
        ];
    }

    /**
     * Check if the user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if the user is currently locked out.
     */
    public function isLocked(): bool
    {
        return $this->locked_until !== null && now()->lessThan($this->locked_until);
    }

    /**
     * Get remaining lockout time in minutes for display.
     */
    public function getRemainingLockTime(): string
    {
        if (!$this->isLocked()) {
            return '0';
        }

        $remaining = now()->diffInSeconds($this->locked_until);

        if ($remaining >= 86400) {
            return (int) ceil($remaining / 86400) . ' hari';
        } elseif ($remaining >= 3600) {
            return (int) ceil($remaining / 3600) . ' jam';
        } elseif ($remaining >= 60) {
            return (int) ceil($remaining / 60) . ' menit';
        }

        return $remaining . ' detik';
    }

    /**
     * Get remaining lockout time in seconds.
     */
    public function getRemainingLockSeconds(): int
    {
        if (!$this->isLocked()) {
            return 0;
        }

        return max(0, now()->diffInSeconds($this->locked_until, false));
    }

    /**
     * Get the progressive lockout duration in minutes based on attempt count.
     *
     * Lockout progression:
     * - 3 failed attempts  →  1 minute
     * - 5 failed attempts  → 30 minutes
     * - 7 failed attempts  → 60 minutes
     * - 9+ failed attempts → 1 day (1440 minutes)
     */
    public static function getLockoutDuration(int $attempts): int
    {
        return match (true) {
            $attempts >= 9 => 1440,     // 1 day
            $attempts >= 7 => 60,       // 60 minutes
            $attempts >= 5 => 30,       // 30 minutes
            $attempts >= 3 => 1,        // 1 minute
            default        => 0,        // not locked
        };
    }

    /**
     * Increment login attempts and set locked_until if threshold reached.
     */
    public function incrementLoginAttempts(): void
    {
        $this->increment('login_attempts');

        $duration = self::getLockoutDuration($this->login_attempts);

        if ($duration > 0) {
            $this->locked_until = now()->addMinutes($duration);
        }

        $this->save();
    }

    /**
     * Reset login attempts and unlock the user.
     */
    public function resetLoginAttempts(): void
    {
        $this->login_attempts = 0;
        $this->locked_until = null;
        $this->save();
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     */
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array<string, mixed>
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
