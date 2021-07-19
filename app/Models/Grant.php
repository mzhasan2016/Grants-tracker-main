<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Services\MoneyService;

class Grant extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * The available grant statuses.
     *
     * @var string
     */
    const STATUS_WON = 'won';
    const STATUS_NOTWON = 'not won';
    const STATUS_APPLICATION = 'application';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'grants';

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

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'decision_date' => 'date',
        'submitted_date' => 'date',
        'awarded_date' => 'date',
        'spend_by_date' => 'date',
        'reporting_date' => 'date'
    ];

    public function awards()
    {
        return $this->hasMany('App\Models\Award');
    }

    public function receivings()
    {
        return $this->hasMany('App\Models\Receiving');
    }

    public function spendings()
    {
        return $this->hasMany('App\Models\Spending');
    }

    public function scopeApplication($query)
    {
        return $query->where('status', Grant::STATUS_APPLICATION);
    }

    public function scopeLive($query)
    {
        return $query->where([
            ['status', Grant::STATUS_WON],
            ['is_completed', false]
        ]);
    }

    public function scopeNotWon($query)
    {
        return $query->where('status', Grant::STATUS_NOTWON);
    }

    public function setAppliedAmountAttribute($value)
    {
        $this->attributes['applied_amount'] = $value * 100;
    }

    public function getAwardedAmountAttribute()
    {
        return $this->awards()->sum('amount');
    }

    public function getReceivedAmountAttribute()
    {
        return $this->receivings()->sum('amount');
    }

    public function getSpentAmountAttribute()
    {
        return $this->spendings()->sum('amount');
    }

    public function getAvailableAmountAttribute()
    {
        return $this->received_amount - $this->spent_amount;
    }

    public function isApplication(): bool
    {
        return $this->status === Grant::STATUS_APPLICATION;
    }

    public function isWon(): bool
    {
        return $this->status === Grant::STATUS_WON;
    }

    public function isComplete(): bool
    {
        return $this->is_completed == true;
    }

    public function markAsCompleted()
    {
        $this->update(['is_completed' => true]);
    }

    public function markAsNotCompleted()
    {
        $this->update(['is_completed' => false]);
    }

    public function formatMoney($value): string
    {
        return MoneyService::format($value);
    }

    public function getFormattedAppliedAmount()
    {
        return MoneyService::format($this->applied_amount);
    }

    public function getFormattedAwardedAmount()
    {
        return MoneyService::format($this->awarded_amount);
    }

    public function getFormattedReceivedAmount()
    {
        return MoneyService::format($this->received_amount);
    }

    public function getFormattedSpentAmount()
    {
        return MoneyService::format($this->spent_amount);
    }

    public function getFormattedAvailableAmount()
    {
        return MoneyService::format($this->available_amount);
    }
}
