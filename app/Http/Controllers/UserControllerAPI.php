<?php

namespace App\Http\Controllers;

use Datetime;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Jsonable;

use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\StoreUserRequest;
use App\Mail\Welcome;
use Hash;

class UserControllerAPI extends Controller
{
    //public function index(Request $request)
    public function index(Request $request)
    {
        //return Input::get('order');
            return UserResource::collection(User::withTrashed()->orderBy('id',"asc")->paginate(5));
       // } else {
           // return UserResource::collection(User::all());
        //}

        /*Caso não se pretenda fazer uso de Eloquent API Resources (https://laravel.com/docs/5.5/eloquent-resources), é possível implementar com esta abordagem:
        if ($request->has('page')) {
            return User::with('department')->paginate(5);
        } else {
            return User::with('department')->get();
        }*/
        //$users= UserResource::collection(User::paginate(5));
        $users= User::orderBy("id","DESC")->paginate(5);
        return response()->json($users);
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function store(Request $request)
    {
        $request->validate([
                'name' => 'required|min:3',//|regex:/^[A-Za-záàâãéèêíóôõúçÁÀÂÃÉÈÍÓÔÕÚÇ ]+$/',
                'username' => 'required|min:3',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:3',
                'type' => 'required|min:3',
                'blocked' => 'required|integer|between:0,1'
            ]);
        $user = new User();
        $user->fill($request->all());
        $user->password = Hash::make($user->password);
        $user->save();
        \Mail::to($user)->send(new Welcome);
        return response()->json($user, 201);
    }

    public function reset(Request $request)
    {
        if (DB::table('users')->where('email','=',$request->email)->exists()) {
            DB::table('password_resets')->where('email','=',$request->email)->delete();
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => str_random(60), //change 60 to any length you want
                'created_at' => new Datetime()
            ]); 

            $tokenData = DB::table('password_resets')
            ->where('email', $request->email)->first();

           $token = $tokenData->token;
           $email = $request->email;

            \Mail::to($request)->send(new Welcome($token,$email));
            return response()->json(201);
        }
        return response()->json(404);
    }              

    public function update(Request $request, $id)
    {
        
        $request->validate([
                'name' => 'nullable|min:3|regex:/^[A-Za-záàâãéèêíóôõúçÁÀÂÃÉÈÍÓÔÕÚÇ ]+$/',
                'username' => 'nullable|min:2',
                'email' => 'nullable|email',
                'type' => 'nullable'
            ]);
        $user = User::findOrFail($id);
        if ($request->has('password')) {
            $request->validate(['password' => 'nullable|min:3']);
            if (!is_null($request->password)) {
                $user->password=Hash::make($request->password);
            }
        }
        if (!is_null($request->name)) {
            $user->name=$request->name;
        }
        if (!is_null($request->username)) {
            $user->username=$request->username;
        }
        if (!is_null($request->type)) {
            if ($request->type=="manager" ||$request->type=="waiter"||$request->type=="cook"||$request->type=="cashier") {
                $user->type=$request->type;
            }
        }
        if (!is_null($request->email)) {
            $user->email=$request->email;
        }
        if (!is_null($request->blocked)) {
            if ($request->blocked==0 || $request->blocked==1) {
                if ($user->blocked!=$request->blocked) {
                    $user->blocked=$request->blocked;
                }
            }
        }
        $user->save();
        return response()->json($user,201);
    }

    public function upload(Request $request,$id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('/public/profiles');
            $name = basename($path);
            
            $oldUrl=DB::table('users')->where('id','=',$id)->value('photo_url');
            $check=Storage::delete('public/profiles/'.$oldUrl);
            $user=User::findOrFail($id);
            $user->photo_url=$name;
            $user->save();
            //DB::table('users')->where('id','=',$id)->update(['photo_url' => $name]);
            return response()->json($user,201);
        }else{
            return response()->json(404);
        }
    }

    public function destroy($id)
    {
        if ($id!=\Auth::guard('api')->user()->id) {
            $user = User::findOrFail($id);
            if($user->forceDelete()){
                return response()->json(null, 204);
            }
           $user->delete();
        }
        return response()->json(null,401);
    }
    public function emailAvailable(Request $request)
    {
        $totalEmail = 1;
        if ($request->has('email') && $request->has('id')) {
            $totalEmail = DB::table('users')->where('email', '=', $request->email)->where('id', '<>', $request->id)->count();
        } else if ($request->has('email')) {
            $totalEmail = DB::table('users')->where('email', '=', $request->email)->count();
        }
        return response()->json($totalEmail == 0);
    }
    
    public function myProfile(Request $request)
    {
        return new UserResource($request->user());
    }
}
