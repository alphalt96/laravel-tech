<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use phpseclib\Crypt\Hash;

class UserController extends Controller
{

    /**
     * Register user and return a token
     *
     * @param UserRegisterRequest $request
     * @return object
     */
    public function register(UserRegisterRequest $request) {
        try {
            $newUser = User::firstOrCreate([
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'email' => $request->email,
                'id_user_role' => '3',
            ]);
            $token = $newUser->createToken('normal_user');
            return response()->json([
                'token' => $token->accessToken
            ], 200);
        } catch (\Exception $e) {
            return response()->json('Intenal Server Error', 500);
        }
    }

    /**
     * Login with return token
     *
     * @param UserLoginRequest $request
     * @return object
     */
    public function login(UserLoginRequest $request) {
        // Return 401 status if user not authorized
        if (!Auth::attempt(['username' => $request->account, 'password' => $request->password]) && !Auth::attempt(['email' => $request->account, 'password' => $request->password])) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Create token login for user with match username or email and password
        $userAuth = Auth::user();
        $token = $userAuth->createToken('normal_user');
        $tokenObject = $token->token;

        // Update token expires if user request
        if ($request->remember_me) {
            $token->token->update(['expires_at' => Carbon::now()->addDay(1)]);
        }

        return response()->json([
            'token' => $token->accessToken,
            'expires_at' => Carbon::parse($token->token->expires_at)->toDateString()
        ], 200);
    }

    /**
     * Get user detail informaltion
     *
     * @param int $id
     * @return object
     */
    public function getUserDetail($id = null) {
        try {
            if (is_null($id)) {
                $id = Auth::id();
            }
            $user = new User($id);
            $data = $user->findUser([
                'id_user', 'username', 'nickname', 'email', 'avatar_link'
            ]);
            dd($data->username);
        } catch (\Exception $e) {

        }
    }
}
