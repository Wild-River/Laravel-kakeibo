<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @param int $id 
 * @param string $name 
 * @param date $created_at 
 * @param date $updated_at 
 */
class Category extends Model
{
    protected $fillable = ['name'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
