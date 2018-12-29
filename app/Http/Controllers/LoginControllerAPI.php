<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

define('YOUR_SERVER_URL', 'http://restaurantManager.dad/');
// Check "oauth_clients" table for next 2 values:
define('CLIENT_ID', '2');
define('CLIENT_SECRET','wr7e7Oq7DuOOKKnmgplUlHTWgMRgGWiBbf0GEBAL');

class LoginControllerAPI extends Controller
{
    public function login(Request $request)
    {
        if(!$this->isBlocked($request)){
            return response()->json(['msg'=>'User Blocked from logging in'], 401);
        }
        $http = new \GuzzleHttp\Client;
            $response = $http->post(YOUR_SERVER_URL.'/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => CLIENT_ID,
                    'client_secret' => CLIENT_SECRET,
                    'username' => $request->email,
                    'password' => $request->password,
                    'scope' => ''
                ],
                'exceptions' => false,
            ]);
        $errorCode= $response->getStatusCode();
        if ($errorCode=='200') {
            return json_decode((string) $response->getBody(), true);
        } else {
            return response()->json(['msg'=>'User credentials are invalid'], $errorCode);
        }
    }
    
    public function isBlocked(Request $request)
    {
        if (DB::table('users')->where('email','=',$request->email)->orWhere('username','=',$request->email)->exists()) {
            if (DB::table('users')->where('email','=',$request->email)->orWhere('username','=',$request->email)->select('blocked')->get()[0]->blocked==1) {
                return false;
            }
        }
        return true;
    }
    
    public function logout()
    {
        \Auth::guard('api')->user()->token()->revoke();
        \Auth::guard('api')->user()->token()->delete();
        return response()->json(['msg'=>'Token revoked'], 200);
    }
}