<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Jsonable;

use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\DB;

use App\User;
use App\StoreUserRequest;
use Hash;

class ShiftControllerAPI extends Controller
{
    public function index(Request $request)
    {
        return "OLA :D";

        

        /*Caso não se pretenda fazer uso de Eloquent API Resources (https://laravel.com/docs/5.5/eloquent-resources), é possível implementar com esta abordagem:
        if ($request->has('page')) {
            return User::with('department')->paginate(5);
        } else {
            return User::with('department')->get();
        }*/
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id' => 'required|min:3|regex:/^[A-Za-záàâãéèêíóôõúçÁÀÂÃÉÈÍÓÔÕÚÇ ]+$/',
            'shift' => 'required|email|unique:users,email,'.$id,
            'shift_date' => 'required|email|unique:users,email,'.$id
        ]);
        $user = User::findOrFail($id);
        $user->update($request->all());
        return new User($user);
    }

    public function shiftStart(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->shift_active=1;
        $user->last_shift_Start = date('Y-m-d H:i:s');
        $user->update();
        return new UserResource($user);
    }

    public function shiftEnd(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->last_shift_end = date('Y-m-d H:i:s');
        $user->shift_active=0;
        $user->update();
        return new UserResource($user);  
    }
 

}
