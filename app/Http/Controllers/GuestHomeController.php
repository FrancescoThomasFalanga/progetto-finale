<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestHomeController extends Controller
{
    public function home() {

        return view('homepage');

    }
}
