<?php

namespace Devfactory\Elshop\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Variation;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'status_id',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];
    
    public function status() {
        return $this->belongsTo('App\Models\Status')
        ->withTrashed();
    }

    public function user() {
        return $this->belongsTo('App\Models\User')
        ->withTrashed();
    }

    public function shipping_method() {
        return $this->belongsTo('App\Models\ShippingMethod')
        ->withTrashed();
    }

    public function payment() {
        return $this->belongsTo('App\Models\Payment')
        ->withTrashed();
    }

    public function products() {
        return $this->belongsToMany('App\Models\Product')
        ->withPivot(['price', 'variation_id', 'quantity'])
        ->withTrashed();
    }

    public function trackings() {
        return $this->hasMany('App\Models\Tracking');
    }

    public function shipping_address() {
        return $this->belongsTo('App\Models\Address', 'address_shipping_id')
        ->withTrashed();
    }

    public function payment_address() {
        return $this->belongsTo('App\Models\Address', 'address_payment_id')
        ->withTrashed();
    }

    public function currency() {
        return $this->belongsTo('App\Models\Currency')
        ->withTrashed();
    }

    public function get_vat_price() {
        return number_format(($this->total) * ($this->vat_used / 100), 2);
    }

    public function get_order_total() {
        if (!is_null($this->coupon_id)) {
            if (get_coupon_discount(TRUE, $this->id)->type == 'price') {
                return number_format($this->total + $this->get_vat_price() - get_coupon_discount(TRUE, $this->id)->value, 2);
            }
            else {
                return number_format($this->total + $this->get_vat_price() - (($this->total + $this->get_vat_price() ) * get_coupon_discount(TRUE, $this->id)->value / 100), 2);                       
            }
        }

        return number_format($this->total + $this->get_vat_price(), 2);
    }

     public function coupon() {
        return $this->belongsTo('App\Models\Coupon')
        ->withTrashed();
    }
}
