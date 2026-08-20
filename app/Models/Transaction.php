<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected function typeLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->type) {
                'income' => '収入',
                'expense' => '支出',
            },
        );
    }

    protected function amountLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => '¥'.number_format($this->amount),
        );
    }

    protected $fillable = [
        'category_id',
        'type',
        'amount',
        'occurred_at',
        'note',
    ];

    protected $casts = [
        'occurred_at' => 'immutable_date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
