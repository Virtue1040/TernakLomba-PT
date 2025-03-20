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
        return view('auth.login');
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
     *         description="The Username / Email",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="The Password",
     *         @OA\Schema(type="password")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Berhasil mengambil data Property",
     *                 "token": "1-adsBASDMzxckopasdkpwqkiqwje"
     *             }
     *         ),
     *     ),
     * )
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $user = Auth::user();
        
        if ($request->header('Accept') === 'application/json') {
            $token = $user->createToken('swagger_api')->plainTextToken;
            return response()->json([
                "success" => true,  
                "status_code" => 200,
                "message" => "Berhasil login",
                "data" => [
                    "token" => $token
                ]
            ], 200);
        } else {
            return redirect()->intended(route('home', absolute: false));
        }
    }

    
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
