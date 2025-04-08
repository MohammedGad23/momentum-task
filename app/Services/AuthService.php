<?php


namespace App\Services;

use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Http\Resources\UserResource;

class AuthService
{
    public function register(array $data)
    {
        try{

            User::create($data);

            return response()->json( [
                'success'=>'User created successfully'
            ],200);

        }catch (\Exception $e){

            return response()->json([
                'error'=>'Something went wrong, Please try again.'
            ],500);
        }
    }

    public function login(array $credentials)
    {

        try{

            $user = User::where('email', $credentials['email'])->first();

            if (!$user || !Hash::check($credentials['password'], $user->password)) {
                return response()->json([
                    'error' => 'Your email or password is incorrect.',
                ], 401);
            }

            return response()->json(
                [
                    'token'=>$user->createToken('auth_token')->plainTextToken,
                ],200);

        }catch (\Exception $e){

            return response()->json([
                'error'=>'Something went wrong, Please try again.'
            ],500);
        }

    }

    public function logout(User $user)
    {
        try{
            $user->currentAccessToken()->delete();

            return response()->json([
                'success'=>'Logged out successfully',
            ],200);

        }catch (\Exception $e){

            return response()->json([
                'error'=>'Something went wrong, Please try again.'
            ],500);

        }
    }

    public function user()
    {
        try{
            return new UserResource(Auth::user());
        }catch (\Exception $e){
            return response()->json([
                'error'=>'Something went wrong, Please try again.'
            ],500);
        }
    }
}
