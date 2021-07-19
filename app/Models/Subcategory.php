<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\MoneyService;

class Subcategory extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subcategories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function receivings()
    {
        return $this->hasMany('App\Models\Receiving');
    }

    public function spendings()
    {
        return $this->hasMany('App\Models\Spending');
    }

    public function getAvailableAmountAttribute()
    {
        return $this->receivings()->sum('amount') - $this->spendings()->sum('amount');
    }

    public function getFormattedAvailableAmount()
    {
        return MoneyService::format($this->available_amount);
    }
}
