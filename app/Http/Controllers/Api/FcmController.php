<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FcmController extends Controller
{
/*      public function guardarToken(Request $request){
        $usuario = Auth::guard('api')->user();
        
        if($request->has('token')){
            $usuario->dispos_token = $request->input('token');
           $usuario->save();
    
        }

        
    } */


    public function postToken(Request $request)
    {
    	// $request->validate($rules);

    	$user = Auth::guard('api')->user();
    	
    	if ($request->has('dispos_token')) {
	    	$user->dispos_token = $request->input('dispos_token');
	    	$user->save();	
    	}    	
    }

}
