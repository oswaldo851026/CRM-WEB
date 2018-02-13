<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Eloquent;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Hashids;
use Cartalyst\Sentry\Throttling\Eloquent\Throttle;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;

 



//class User extends Authenticatable

class User extends \Cartalyst\Sentry\Users\Eloquent\User 
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     public function getAuthIdentifier()
    {
        return $this->getKey();
    }

      public static function boot()
    {
        parent::boot();
        static::setHasher(app()->make('sentry.hasher'));
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }
    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }
    
    public function setRememberToken($value)
    {
        $this->persist_code = $value;

        $this->save();
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return "persist_code";
    }

    /**
     * Use a mutator to derive the appropriate hash for this user
     *
     * @return mixed
     */
    public function getHashAttribute()
    {
        return Hashids::encode($this->attributes['id']);
    }

    /**
     * Use an accessor method to get the user's status from the throttle table
     * @return [type] [description]
     */
    public function getStatusAttribute()
    {
        $status = "Not Active";
        if ($this->isActivated()) {
            $status = "Active";
        }

        //Check for suspension
        if ($this->throttle && $this->throttle->isSuspended()) {
            $status = "Suspended";
        }

        //Check for ban
        if ($this->throttle && $this->throttle->isBanned()) {
            $status = "Banned";
        }

        return $status;
    }
    
      

}
