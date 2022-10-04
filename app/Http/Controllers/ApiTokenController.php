<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Support\Facades\DB;

class ApiTokenController extends Controller
{
    public function createToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'device_name' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
            //return  response()->json(['err=> $validator->errors() ]);
        }
        $user = User::where('email', '=', $request['email'])->first();
        //$user = DB::table('users')->where('email', $request->email)->first(); // одна запись
        //если пользователь не пустой
        if (!$user || !Hash::check($request['password'], $user->password)) {
            return response()->json(['error' => 'The provided credintial are incorrect'], 401);
        }
        $token = $user->createToken($request['device_name']);
        return ['token' => $token->plainTextToken];
    }


}
