<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @param  int  $id
 * @param  string  $name
 * @param  date  $created_at
 * @param  date  $updated_at
 */
class Category extends Model
{
    protected $fillable = ['name'];

    /**
     * @return HasMany<Transaction, $this>
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
