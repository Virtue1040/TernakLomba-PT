<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorewinnerRequest;
use App\Http\Requests\UpdatewinnerRequest;
use App\Models\lombaHadiah;
use App\Models\User;
use App\Models\winner;

class WinnerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:lomba-setwinner', ['only' => ['store']]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Reset Channel
     * @OA\Post(
     *     security={{"bearerAuth":{}}},
     *     path="/api/v1/winner",
     *     tags={"Winner"},
     *     operationId="winner-store",
     *     summary="Set the winner of lomba",
     *     description="Pilih pemenang dari lomba",
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "status_code": 200,
     *                 "message": "Berhasil memilih pemenang lomba",
     *                 "data" : {
     *                      "user_id": 1,
     *                      "hadiah_id": 1,
     *                      "user_alias": null,
     *                      "juara": "Juara 1"
     *                  }
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
    public function store(StorewinnerRequest $request)
    {
        $request->validate([
            'user_id' => ["integer", "exists:".User::class.",id_user"],
            'hadiah_id' => ["integer", "exists:".lombaHadiah::class.",id_hadiah"],
            'user_alias' => ["string", "required_if:user_id,null"],
            'juara' => ["required", "string"],
        ]);

        $user_id = $request->user_id;
        $hadiah_id = $request->hadiah_id;
        $user_alias = $request->user_alias;
        $juara = $request->juara;

        $winner = winner::create([
            "user_id" => $user_id,
            "hadiah_id" => $hadiah_id,
            "user_alias" => $user_alias,
            "juara" => $juara
        ]);

        return response()->json([
            'success' => true,
            'status_code' => 200,
            'message' => 'Berhasil memilih pemenang lomba',
            'data' => $winner,
        ]);
    }
    /**
     * Display the specified resource.
     */
    public function show(winner $winner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(winner $winner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatewinnerRequest $request, winner $winner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(winner $winner)
    {
        //
    }
}
