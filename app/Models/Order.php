<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['total', 'status', 'number', 'guest_first_name', 'guest_last_name', 'guest_address', 'guest_email'];

    public function dishes()
    {

        return $this->belongsToMany(Dish::class)
            ->withPivot('dish_id', 'order_id');
    }
}
