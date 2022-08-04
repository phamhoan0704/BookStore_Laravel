<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;
        protected $fillable=[

    ];
    // public function author()
    // {
    //     return $this->belongsTo(Author::class);
    // }
    // public function category()
    // {
    //     return $this->belongsTo(Author::class);
    // }
    // public function orders()
    // {
    //     return $this->belongsToMany(Order::class);
    // }
}
