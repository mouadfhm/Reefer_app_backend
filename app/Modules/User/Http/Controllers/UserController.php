<?php

namespace App\Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\User\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("User::welcome");
    }
    public function index()
    {
        try {
            $users = User::with('fonction')->get();
            return [
                "payload" => $users,
                "status" => 200
            ];
        } catch (\Exception $e) {
            return [
                "error" => $e->getMessage(),
                "status" => 500
            ];
        }
    }

    public function register(Request $request)
    {
        $rules = [
            'matricule' => 'required|string|unique:users|max:255',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'fonction_id' => 'required|integer|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ];
        $validator = Validator($request->all(), $rules);
        if ($validator->fails()) {
            return [
                "error" => $validator->errors()->all(),
                "status" => 422
            ];
        }
        try {
            $user = User::create([
                'matricule' => $request->matricule,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'fonction_id' => $request->fonction_id,
                'password' => Hash::make("123456"),
            ]);
            return [
                "payload" => $user,
                "status" => 201,
                "message" => "User created successfully"
            ];
        } catch (\Exception $e) {
            return [
                "error" => $e->getMessage(),
                "status" => 500
            ];
        }
    }
    public function login(Request $request)
    {

        $rules = [
            'matricule' => 'required|string|max:255',
            'password' => 'required|string',
        ];
        $validator = Validator($request->all(), $rules);
        if ($validator->fails()) {
            return [
                "error" => $validator->errors()->all(),
                "status" => 422
            ];
        }
        try {
            if (Auth::attempt($request->only('matricule', 'password'))) {
                $user = Auth::user();
                $token = $user->createToken('token')->plainTextToken;
                $user->load('fonction');

                return [
                    "payload" => ['user' => $user, 'token' => $token],
                    "status" => 200
                ];
            } else {
                return [
                    "error" => "Invalid credentials",
                    "status" => 401
                ];
            }
        } catch (\Exception $e) {
            return [
                "error" => $e->getMessage(),
                "status" => 500
            ];
        }
    }
    public function update(Request $request)
    {
        $id = $request->input("id");
        $user = User::findOrFail($id);
        
        
        try {
            $user->update($request->all());
            return [
                "payload" => $user,
                "status" => 200
            ];
        } catch (\Exception $e) {
            return [
                "error" => $e->getMessage(),
                "status" => 500
            ];
        }
    }
    public function delete(Request $request)
    {
        $id = $request->input("id");
        $user = User::findOrFail($id);
        try {
            $user->delete();
            return [
                "payload" => $user,
                "status" => 200
            ];
        } catch (\Exception $e) {
            return [
                "error" => $e->getMessage(),
                "status" => 500
            ];
        } catch (\Exception $e) {
            return [
                "error" => $e->getMessage(),
                "status" => 500
            ];
        }
    }
    public function logout()
    {
        auth()->user()->tokens()->delete();
        $user = Auth::user();
        return [
            "payload" => $user,
            "message" => "User logged out successfully",
            "status" => 200
        ];
    }
    public function resetPassword(Request $request)
    {
        $id = $request->input("id");
        $user = User::findOrFail($id);
        try {
            $user->password = Hash::make("123456");
            $user->save();
            return [
                "payload" => $user,
                "status" => 200
            ];
        } catch (\Exception $e) {
            return [
                "error" => $e->getMessage(),
                "status" => 500
            ];
        } catch (\Exception $e) {
            return [
                "error" => $e->getMessage(),
                "status" => 500
            ];
        }
    }
    public function changePassword(Request $request)
    {
        $user = Auth::user();
        $rules = [
            'password' => 'required|string',
            'new_password' => 'required|string',
        ];
        $validator = Validator($request->all(), $rules);
        if ($validator->fails()) {
            return [
                "error" => $validator->errors()->all(),
                "status" => 422
            ];
        }
        try {
            if (hash::check($request->password, $user->password)) {
                $user->password = Hash::make($request->new_password);
                $user->save();
                return [
                    "payload" => $user,
                    "status" => 200
                ];
            } else {
                return [
                    "error" => "Invalid credentials",
                    "status" => 401
                ];
            }
        } catch (\Exception $e) {
            return [
                "error" => $e->getMessage(),
                "status" => 500
            ];
        }
    }

}
