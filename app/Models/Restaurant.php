<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = ['activity_name', 'phone_number', 'address', 'vat', 'cover_image', 'type_id'];

    public function types() {

        return $this->belongsToMany(Type::class);

    }

    public function dishes() {

        return $this->hasMany(Dish::class);

    }
}
