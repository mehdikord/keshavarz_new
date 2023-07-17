<?php
namespace App\Repository\Auth;

use App\Interfaces\Auth\AuthInterface;

class AuthRepository implements AuthInterface
{
    public function manage_login($request)
    {

        $credentials = request(['email', 'password']);
        if (! $token = auth('admin')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    public function manage_logout()
    {

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
            'user' => auth('admin')->user(),
        ]);
    }

}
