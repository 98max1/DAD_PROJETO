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
       $pessoas = User::paginate(15);
       return ArticleResource::collection($article);

        $user = User::findOrFail($id);
        $user->update($request->all());
        return new UserResource($user);
        

        /*Caso não se pretenda fazer uso de Eloquent API Resources (https://laravel.com/docs/5.5/eloquent-resources), é possível implementar com esta abordagem:
        if ($request->has('page')) {
            return User::with('department')->paginate(5);
        } else {
            return User::with('department')->get();
        }*/
    }
}
