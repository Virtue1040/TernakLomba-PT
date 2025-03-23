<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Users_detail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Register account
     * @OA\Post(
     *     path="/api/auth/register",
     *     tags={"Authentication"},
     *     operationId="register",
     *     summary="Register to get Authentication Token",
     *     description="Register user",
     *     @OA\Parameter(
     *         name="username",
     *         in="query",
     *         description="Username",
     *         example="user",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="Email",
     *         example="user@gmail.com",
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
     *     @OA\Parameter(
     *         name="password_confirmation",
     *         in="query",
     *         description="Password Confirmation",
     *         required=true,
     *         @OA\Schema(type="string", format="password")
     *     ),
     *     @OA\Parameter(
     *         name="first_name",
     *         in="query",
     *         example="John",
     *         description="First Name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *         @OA\Parameter(
     *         name="last_name",
     *         in="query",
     *         example="Doe",
     *         description="Last Name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="gender",
     *         in="query",
     *         example="male",
     *         description="Gender",
     *         required=true,
     *         @OA\Schema(type="string", enum={"male", "female"})
     *     ),
     *     @OA\Parameter(
     *         name="born_date",
     *         in="query",
     *         description="Born date",
     *         example = "2025-03-20",
     *         required=true,
     *         @OA\Schema(type="string", format="date")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "status_code": 200,
     *                 "message": "Berhasil register",
     *                 "data": {
     *                     "token": "1-adsBASDMzxckopasdkpwqkiqwje" 
     *                 }
     *             }
     *         ),
     *     ),
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'first_name' => ["required", "string", "max:255"],
            'last_name' => ["required", "string", "max:255"],
            'gender' => ["required", "string", "max:255", "in:male,female"],
            'born_date' => ["required", "date"],
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user_detail = Users_detail::create([
            'user_id' => $user->id_user,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'bio' => '',
            'gender' => $request->gender,
            'born_date' => $request->born_date
        ]);

        // Assign user to normal user role
        $user->assignRole([3]);

        event(new Registered($user));

        if ($request->header('Accept') === 'application/json') {
            $token = $user->createToken('swagger_api')->plainTextToken;
            return response()->json([
                "success" => true,  
                "status_code" => 200,
                "message" => "Berhasil register",
                "data" => [
                    "token" => $token
                ]
            ], 200);
        } else {
            return redirect(route('dashboard', absolute: false));
        }
    }
}
