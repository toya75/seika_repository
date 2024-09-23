<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Gacha;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

class GachaController extends Controller
{
    public function gacha_show(){

    return view('gachas.index');
    }
    
    public function gacha_draw(Request $request, User $users)
    {   
        
        $user = $users::find(Auth::id());
        $gachapt = Auth::user()->gacha_pt;
        
        $item = Gacha::inRandomOrder()->first();
        $resultname = $item->name;
        $resulturl = $item->image_url;
        
        $gachapt -= 5;
        $user->gacha_pt = $gachapt;
        $user->save();

        return view('gachas.result', compact('resultname', 'resulturl'));
    }
}