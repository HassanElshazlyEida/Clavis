<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserCollection;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\LoginRequest;

class UserController extends BaseController
{
    protected $model = User::class;
    protected $resource = UserResource::class;

    protected function getValidationRules($id = null)
    {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ];

        if ($id) {
            $rules['email'] = 'required|email|unique:users,email,' . $id;
            $rules['password'] = 'nullable|min:8';
        }

        return $rules;
    }
    public function register(RegisterRequest $request)
    {
       

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            "phone"=>$request->phone
        ]);

        $token = $user->createToken('api-token')->plainTextToken;
        
        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $filename = Str::random(20) . '.' . $profilePicture->getClientOriginalExtension();
            $profilePicture->storeAs('public', $filename);
            $user->profile_picture = $filename;
            $user->save();
        }

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
            ]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }
    
}
