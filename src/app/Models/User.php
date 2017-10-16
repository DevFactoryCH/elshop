<?php

namespace Devfactory\Elshop\App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    /* need this tto avoid conflit with entrust and soft delete*/
    use EntrustUserTrait { restore as private restoreA; }
    use SoftDeletes { restore as private restoreB; }

    /* need this tto avoid conflit with entrust and soft delete*/
    public function restore() {
        $this->restoreA();
        $this->restoreB();
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'default_payment_address',
        'default_shipping_address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function addresses() {
        return $this->hasMany('Devfactory\Elshop\App\Models\Address');
    }


    public function orders() {
        return $this->hasMany('Devfactory\Elshop\App\Models\Order');
    }
}
