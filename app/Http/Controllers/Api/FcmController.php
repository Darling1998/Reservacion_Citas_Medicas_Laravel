<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FcmController extends Controller
{
     public function guardarToken(Request $request){
        $usuario = Auth::guard('api')->user();
        
        if($request->has('token')){
            $usuario->dispos_token = $request->input('token');
            $usuario->save();
        }

    }
}
