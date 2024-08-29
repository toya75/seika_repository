<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Gacha;

class GachaController extends Controller
{
    public function gacha_show(){
    return view('gachas.index');
    }
}