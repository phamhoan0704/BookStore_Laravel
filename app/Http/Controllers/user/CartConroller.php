<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartConroller extends Controller
{
    protected $cartService;
    public function __construct(CartService $cartService)
    {
        $this->authorService=$cartService;
    }
    
}
