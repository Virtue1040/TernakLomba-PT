<?php

namespace App\Http\Controllers\Lomba;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lomba\StorelombaTeamRequest;
use App\Http\Requests\Lomba\UpdatelombaTeamRequest;
use App\Models\Lomba;
use App\Models\lombaTeam;
use App\Models\User;

class LombaTeamController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:lomba-read', ['only' => ['index', 'show']]);
        $this->middleware('permission:lomba-creates', ['only' => ['create', 'store']]);
        $this->middleware('permission:lomba-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:lomba-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Get All Lomba Team
     * @OA\Get(
     *     security={{"bearerAuth":{}}},
     *     path="/api/v1/lombaTeam",
     *     tags={"Lomba Team"},
     *     operationId="lombaTeam-all",
     *     summary="Get All Lomba Team",
     *     description="Mengambil Semua data Lomba Team",
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "status_code": 200,
     *                 "message": "Berhasil mengambil data lomba team",
     *                 "data": {
     *                      {
     *                          "id_team": 1,
     *                          "lomba_id": 1,
     *                          "team_code": "0019",
     *                          "isPrivate": false,
     *                          "isApproved": false
     *                      }
     *                 },
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
    public function all()
    {
        $lomba = lombaTeam::all();
        return response()->json([
            'success' => true,
            'status_code' => 200,
            'message' => "Berhasil mengambil data lomba member",
            'data' => $lomba
        ]);
    }

    /**
     * Get One Lomba Member Team
     * @OA\Get(
     *     security={{"bearerAuth":{}}},
     *     path="/api/v1/lombaTeam/get/{id_team}",
     *     tags={"Lomba Team"},
     *     operationId="lombaTeam-get",
     *     summary="Get One Lomba Team",
     *     description="Mengambil data Lomba Team",
     *     @OA\Parameter(
     *         name="id_team",
     *         in="path",
     *         description="Team ID",
     *         example = 1,
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "status_code": 200,
     *                 "message": "Berhasil mengambil data lomba team",
     *                 "data": {
     *                          "id_team": 1,
     *                          "lomba_id": 1,
     *                          "team_code": "0019",
     *                          "isPrivate": false,
     *                          "isApproved": false
     *                 },
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
    public function get(lombaTeam $lombaTeam, $id_team)
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store Lomba Team
     * @OA\Post(
     *     security={{"bearerAuth":{}}},
     *     path="/api/v1/lombaTeam",
     *     tags={"Lomba Team"},
     *     operationId="lombaTeam-store",
     *     summary="Create Team Lomba",
     *     description="Membuat Team Lomba",
     *     @OA\Parameter(
     *         name="lomba_id",
     *         in="query",
     *         description="Lomba ID",
     *         example = 1,
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="leader_user_id",
     *         in="query",
     *         description="Leader User ID",
     *         example = 1,
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "status_code": 200,
     *                 "message": "Berhasil menambahkan data team lomba",
     *                 "data": {
     *                          "id_team": 1,
     *                          "lomba_id": 1,
     *                          "team_code": "0019",
     *                          "isPrivate": false,
     *                          "isApproved": false
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
    public function store(StorelombaTeamRequest $request)
    {
        $request->validate([
            'lomba_id' => ["required", "integer", "exists:".Lomba::class],
        ]);
        $lomba_id = $request->lomba_id;

        $team = lombaTeam::create([
            'lomba_id' => $lomba_id,
            'team_code' => rand(1000, 9999),
            'isPrivate' => false,
            'isApproved' => false
        ]);

        return response()->json([
            "success" => true,
            "status_code" => 200,
            "message" => "Berhasil menambahkan data team lomba",
            "data" => $team
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(lombaTeam $lombaTeam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(lombaTeam $lombaTeam)
    {
        //
    }

    /**
     * Update Lomba Team
     * @OA\Put(
     *     security={{"bearerAuth":{}}},
     *     path="/api/v1/lombaTeam/{id_team}",
     *     tags={"Lomba Team"},
     *     operationId="lombaTeam-update",
     *     summary="Update Team Lomba",
     *     description="Mengubah data Team Lomba",
     *     @OA\Parameter(
     *         name="id_team",
     *         in="path",
     *         description="Team Lomba ID",
     *         example = 1,
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="isApproved",
     *         in="query",
     *         description="Apakah diApprove?",
     *         example = true,
     *         required=true,
     *         @OA\Schema(type="boolean")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "status_code": 200,
     *                 "message": "Berhasil menambahkan data team lomba",
     *                 "data": {
     *                          "id_team": 1,
     *                          "lomba_id": 1,
     *                          "team_code": "0019",
     *                          "isPrivate": false,
     *                          "isApproved": false
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
    public function update(UpdatelombaTeamRequest $request, lombaTeam $lombaTeam, $id_team)
    {
        $request->validate([
            "isPrivate" => ["required", "boolean"]
        ]);
        $isPrivate = $request->isPrivate;

        $team = $lombaTeam::findOrFail($id_team);
        $team->isPrivate = $isPrivate;

        return response()->json([
            "success" => true,
            "status_code" => 200,
            "message" => "Berhasil mengubah data team lomba",
            "data" => $team
        ]);
    }

    /**
     * Delete Lomba Team
     * @OA\Delete(
     *     security={{"bearerAuth":{}}},
     *     path="/api/v1/lombaTeam/{id_team}",
     *     tags={"Lomba Team"},
     *     operationId="lombaTeam-delete",
     *     summary="Menghapus Team Lomba",
     *     description="Menghapus data Team Lomba",
     *     @OA\Parameter(
     *         name="id_team",
     *         in="path",
     *         description="Team Lomba ID",
     *         example = 1,
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "status_code": 200,
     *                 "message": "Berhasil menambahkan data team lomba",
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
    public function destroy(lombaTeam $lombaTeam, $id_team)
    {
        $team = $lombaTeam::findOrFail($id_team);
        $team->delete();

        return response()->json([
            "success" => true,
            "status_code" => 200,
            "message" => "Berhasil menghapus data team lomba",
        ]);
    }
}
