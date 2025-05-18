<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's profile
     */
    public function index(Request $request, $id_user = null): View
    {
        if ($id_user === null) {
            $id_user = $request->user()->id_user;
        }

        $user = User::findOrFail($id_user);
        return view("display.profile.index", [
            "profile" => $user,
        ]);
    }

    /**
     * Update Profile
     * @OA\Put(
     *     security={{"bearerAuth":{}}},
     *     path="/api/v1/profile/",
     *     tags={"Profile"},
     *     operationId="profile-update",
     *     summary="Update Profile",
     *     description="Mengubah data Profile user",
     *     @OA\Parameter(
     *         name="bio",
     *         in="query",
     *         description="Tentang user",
     *         example = "Hi, i'm new here",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "status_code": 200,
     *                 "message": "Berhasil mengupdate data user",
     *             }
     *         ),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Error: Unauthorized",
     *         @OA\JsonContent(
     *             example={
     *                 "success": false,
     *                 "status_code": 401,
     *                 "message": "Unauthorized"
     *             }
     *         ),
     *     ),
     *     @OA\Response(
     *         response="403",
     *         description="Error: Forbidden",
     *         @OA\JsonContent(
     *             example={
     *                 "success": false,
     *                 "status_code": 403,
     *                 "message": "Forbidden - You do not have permission"
     *             }
     *         ),
     *     ),
     * )
     */
    public function update(ProfileUpdateRequest $request)
    {
        $validate = $request->validate([
            "bio" => ["string", "max:255"],
            "first_name" => ["string", "max:255"],
            "last_name" => ["string", "max:255"]
        ]);

        auth("sanctum")->user()->user_detail->update($validate);

        return response()->json([
            'success' => true,
            'status_code' => 200,
            'message' => "Berhasil mengupdate data user",
        ]);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
