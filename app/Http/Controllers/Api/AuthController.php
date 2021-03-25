<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Factory ;
use JWTAuth;
use Illuminate\Support\Facades\DB;
class AuthController extends Controller
{

    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'registro','validar']]);
    }

      public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            $mensaje=false;
            return response()->json($mensaje);
        }

        if (! $token = auth('api')->attempt($validator->validated())) {
            return response()->json(['error' => '$token'], 401);
        }

        
        return $this->createNewToken($token);
    }
  


    public function registro(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users,email',
            'password' => 'required|string|min:8',
            'apellido'=>'required|min:3',
            'cedula'=>'nullable|digits:10|unique:users,cedula',
            'telefono'=>'nullable|min:7',
            'direccion'=>'nullable|string'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password),'role_id'=>'3']
                ));

        return response()->json([
            'message' => 'success',
            'toast'=>'Registro Exitoso',
            'user' => $user
        ], 201);
    }



   protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth('api')->user()
        ]);
    }  



}