<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('display.auth.login');
    }

    /**
     * Get User Token
     * @OA\Post(
     *     path="/api/auth/login",
     *     tags={"Authentication"},
     *     operationId="login",
     *     summary="Login to get Authentication Token",
     *     description="Mengambil Token User",
     *     @OA\Parameter(
     *         name="username",
     *         in="query",
     *         description="Username / Email",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="Password",
     *         required=true,
     *         @OA\Schema(type="string", format="password")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "status_code": 200,
     *                 "message": "Berhasil login",
     *                 "data": {
     *                     "token": "1-adsBASDMzxckopasdkpwqkiqwje"
     *                 }
     *             }
     *         ),
     *     ),
     * )
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $user = Auth::user();
        
        $user->tokens()->where("name", 'authentication')->delete();
        $token = $user->createToken('authentication')->plainTextToken;
        $cookie = cookie(env("TOKEN_NAME", "auth_token"), $token, 60 * 24 * 7, '/', null, true, true, false, 'lax');
        
        if ($request->wantsJson()) {
            session()->regenerate();
            return response()->json([
                "success" => true,  
                "status_code" => 200,
                "message" => "Berhasil login",
                "data" => [
                    "token" => $token
                ]   
            ], 200);
        } else {
            return redirect()->route("profiling")->withCookie($cookie);
        }
    }

    /**
     * Logout User Token
     * @OA\Get(
     *     path="/api/auth/logout",
     *     tags={"Authentication"},
     *     operationId="logout",
     *     summary="Logout and revoke all token",
     *     description="Logout token user",
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "status_code": 200,
     *                 "message": "Berhasil logout",
     *             }
     *         ),
     *     ),
     * )
     */
    public function destroy(Request $request)
    {
 
        if (auth("sanctum")->check()) {
            auth("sanctum")->user()->tokens()->where("name", 'authentication')->delete();
        }

        session()->invalidate();

        session()->regenerateToken();

        if ($request->wantsJson()) {
            session()->regenerate();
            return response()->json([
                "success" => true,  
                "status_code" => 200,
                "message" => "Berhasil logout", 
            ], 200);
        } else {
            return redirect('/');
        }
    }
}
