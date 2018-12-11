<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use phpseclib\Crypt\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    protected $userModel;

    public function __construct(UserRepositoryInterface $userModel)
    {
        $this->userModel = $userModel;
    }

    /**
     * Register user and return a token
     *
     * @param UserRegisterRequest $request
     * @return object
     */
    public function register(UserRegisterRequest $request) {
        $dataUserCreate = [
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'id_user_role' => 3
        ];
        $newUser = $this->userModel->createUser($dataUserCreate);
        $token = $newUser->createToken('normal_user');
        return response()->json([
            'token' => $token->accessToken
        ], 200);
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
        if (is_null($id)) {
            $id = Auth::id();
        }
        $data = $this->userModel->getUserDetail($id, ['username', 'email', 'password']);
//            dd($data);
        $customData = collect($data);

        $s = $customData->mapWithKeys(function($item) {
//            dd($item);
            return [
                'user_name' => $item
            ];
        });

        dd($s);

        $test = collect([
            'status' => 'success',
            'user' => $data
        ]);
//        dd($test);

        return response()->json([
            'data' => $test
        ], 200);
    }

    public function putUserDetail(Request $request) {
        if ($request->hasFile('avatar')) {
            $request->file('avatar')->store(
                'avatars/', 'minio'
            );
//            $fileName = $request->file('avatar')->hashName();
//            $fileContent = $request->file('avatar');
//            Storage::cloud()->put('avatars', $fileContent);
        }
    }
}
