<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group  Authentication
 *
 * APIs for Authentication drivers
 */
class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.verify', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @bodyParam  email string required The Email of the Driver. Example: karim.elbadry2@gmail.com
     * @bodyParam  password string required The Password of the Driver. Example: karim
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'email' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(["errors" => $validator->errors()], 400);
        }
        $credentials = request(['email', 'password']);

        if (! $token = auth('drivers')->attempt($credentials)) {
            return response()->json(['error' => 'Wrong email or password'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated Driver.
     *
     * @authenticated
     * @bodyParam  email string required The Email of the Driver. Example: karim.elbadry2@gmail.com
     * @bodyParam  password string required The Password of the Driver. Example: karim
     *
     * @return JsonResponse
     */
    public function me()
    {
        $user= auth('drivers')->user();
        $user->avatar= $user->getFirstMediaUrl('avatar');
        return response()->json($user);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @authenticated
     *
     * @return JsonResponse
     */
    public function logout()
    {
        auth('drivers')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @authenticated
     *
     * @return JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('drivers')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => null
        ]);
    }
}
