<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    /**
     * @return Attribute<string, never>
     */
    protected function typeLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->type) {
                'income' => '収入',
                'expense' => '支出',
                default => $this->type,
            },
        );
    }

    /**
     * @return Attribute<string, never>
     */
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

    /**
     * @return BelongsTo<Category, $this>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
