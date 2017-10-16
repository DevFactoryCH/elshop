<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Devfactory\Media\MediaTrait;

class Variation extends Model
{
    use MediaTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stock',
        'name',
        'price',
        'product_id'
    ];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    public function product()
    {
        return $this->belongsTo('Devfactory\Elshop\App\Models\Product')->withTrashed();
    }

    public function types()
    {
        return $this->belongsToMany('Devfactory\Elshop\App\Models\Type')->withTrashed();
    }

    public function pictures(){
        return $this->hasMany('Devfactory\Elshop\App\Models\Picture');
    }

    /**
     * Get the variation's price
     *
     * @param  string  $value
     * @return string
     */
    public function getPriceAttribute($value) {
        $currency = get_currency();

        return number_format($value / 100 * $currency->conversion_rate, 2);
    }

    public function price_with_currency() {
        return $this->price." ".get_currency()->symbol;
    }

    public function discount_price_with_currency() {
        return $this->discount_price()." ".get_currency()->symbol;
    }

    public function discount_price() {
        
        $price = $discount_price = $this->price;
        $currency = get_currency();

        if (count($this->product->discounts)) {
            $date_today = strtotime(date('Y-m-d'));
            foreach ($this->product->discounts as $discount) {
                $discount_start = strtotime($discount->start_date);
                $discount_end = strtotime($discount->end_date);
                //if has date check if valide
                if (!is_null($discount->end_date) || !is_null($discount->start_date)){
                    if (is_null($discount->end_date) && $discount_start > $date_today) continue;
                    if (is_null($discount->start_date) && $discount_end < $date_today) continue;
                    if (!is_null($discount->end_date) && !is_null($discount->start_date) && ($discount_start > $date_today || $discount_end < $date_today)) {
                       continue;
                    }
                }

                if ($discount->new_price) {
                    $discount_price = $discount->new_price;
                    break;
                }

                if ($discount->percentage) {
                    $discount_price -= $price / 100 * $discount->percentage;
                }
            }

            return number_format($discount_price, 2);
        }
        
        return number_format($price, 2);
    }
}
