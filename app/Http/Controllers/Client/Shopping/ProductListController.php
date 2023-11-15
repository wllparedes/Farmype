<?php

namespace App\Http\Controllers\Client\Shopping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductListController extends Controller
{
    public function index(){
        return view('client.products.selected-products');
    }
}
