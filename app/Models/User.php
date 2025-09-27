<?php

namespace App\Models;

 use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Relations\BelongsToMany;
 use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
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
        ];
    }

    public function prizes(): BelongsToMany
    {
        return $this->belongsToMany(Prize::class, 'prize_histories')->withTimestamps();
    }

    /**
     * 抽選可能回数
     */
    public function remainingNumberOfDrawing(): int
    {
        // config/lottery.phpのdraw_limit にある1日あたりの最大抽選可能回数を取得
        return config('lottery.draw_limit') - $this->prizes()->whereDate('prize_histories.created_at', today())->count();
    }

    public function newMailAddress()
    {
        return $this->hasOne(NewMailAddress::class);
    }

    public function getEmailForVerification()
    {
        if($this->hasVerifiedEmail() && $this->newMailAddress?->email){
            return $this->newMailAddress->email;
        }
        return $this->email;
    }

    /**
     * メールの送信先
     * @param $notification
     * @return string
     */
     public function routeNotificationForMail($notification = null)
     {
         return $this->getEmailForVerification();
     }
}
