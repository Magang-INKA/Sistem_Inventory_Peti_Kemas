<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // public function login()
    // {
    //     $credentials = request(['email', 'password']);

    //     if (!$token = auth()->attempt($credentials)) {
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }

    //     $data = (object) [
    //         'user' => $this->me()->original,
    //         'token' => $this->respondWithToken($token)->original,
    //     ];
    //     return response()->json([
    //         'status' => 200,
    //         'message' => 'berhasil login',
    //         'data' => $data
    //     ]);
    // }
    //https://571e-125-164-232-199.ap.ngrok.io/api/user

    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $data = (object) [
            'user' => $this->me()->original,
            'token' => $this->respondWithToken($token)->original,
        ];

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['message' => 'Hi '.$user->name.', welcome to home','access_token' => $token, 'token_type' => 'Bearer', 'data' => $data ]);
    }

    // public function register(RegisterRequest $request)
    // {
    //     $data = User::create([
    //         'nama' => $request->nama,
    //         'email' => $request->email,
    //         'username' => $request->username,
    //         'password' => Hash::make($request->password),
    //         'telepon' => $request->telepon,
    //         'alamat' => $request->alamat,
    //         'role' => $request->role
    //     ]);

    //     return response()->json(
    //         [
    //             'status' => 200,
    //             'message' => 'Data created successfully.',
    //             'data' => $data
    //         ]
    //     );
    // }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        //return response()->json(User::with('laundry')->find(auth()->user()->id));
        return response()->json(User::find(auth()->user()->id));
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(
            ['message' => 'Successfully logged out']
        );
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            // 'expires_in' => auth()->factory()->getTTL() * 60
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}