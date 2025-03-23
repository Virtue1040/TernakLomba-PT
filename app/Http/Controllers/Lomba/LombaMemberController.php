<?php

namespace App\Http\Controllers\Lomba;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lomba\StorelombaMemberRequest;
use App\Http\Requests\Lomba\UpdatelombaMemberRequest;
use App\Models\lombaMember;
use App\Models\lombaTeam;

class LombaMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Get All Lomba Members
     * @OA\Get(
     *     security={{"bearerAuth":{}}},
     *     path="/api/lombaMember",
     *     tags={"Lomba Member"},
     *     operationId="lombaMember-all",
     *     summary="Get All Lomba Member",
     *     description="Mengambil Semua data Lomba Member",
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "status_code": 200,
     *                 "message": "Berhasil mengambil data lomba member",
     *                 "data": {
     *                      {
     *                          "id_member": 1,
     *                          "team_id": 1,
     *                          "role": "hacker",
     *                          "isLeader": false
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
     * )
     */
    public function all()
    {
        $lomba = lombaMember::all();
        return response()->json([
            'success' => true,
            'status_code' => 200,
            'message' => "Berhasil mengambil data lomba member",
            'data' => $lomba
        ]);
    }

    /**
     * Get One Lomba Member
     * @OA\Get(
     *     security={{"bearerAuth":{}}},
     *     path="/api/lombaMember/get/{id_member}",
     *     tags={"Lomba Member"},
     *     operationId="lombaMember-get",
     *     summary="Get One Lomba Member",
     *     description="Mengambil data Lomba Member",
     *     @OA\Parameter(
     *         name="id_member",
     *         in="path",
     *         description="Member ID",
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
     *                 "message": "Berhasil mengambil data lomba member",
     *                 "data": {
     *                      "id_member": 1,
     *                      "team_id": 1,
     *                      "role": "hacker",
     *                      "isLeader": false
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
     * )
    */
    public function get(lombaMember $lombaMember, $id_member)
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
     * Store Lomba Member
     * @OA\Post(
     *     security={{"bearerAuth":{}}},
     *     path="/api/lombaMember",
     *     tags={"Lomba Member"},
     *     operationId="lombaMember-store",
     *     summary="Create Lomba Member",
     *     description="Membuat Lomba Member",
     *     @OA\Parameter(   
     *         name="team_id",
     *         in="query",
     *         description="Team ID",
     *         example = 1,
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="role",
     *         in="query",
     *         description="Role Name",
     *         example = "Hacker",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="isLeader",
     *         in="query",
     *         description="Apakah Leader",
     *         example = false,
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
     *                 "message": "Berhasil menambahkan data lomba member",
     *                 "data": {
     *                      "id_member": 1,
     *                      "team_id": 1,
     *                      "role": "hacker",
     *                      "isLeader": false
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
     * )
     */
    public function store(StorelombaMemberRequest $request)
    {
        $request->validate([
            "team_id" => ["required", "integer", "exists:".lombaTeam::class],
            "role" => ["required", "string", "max:255"],
            "isLeader" => ["required", "boolean"]
        ]);
        $team_id = $request->team_id;
        $role = $request->role;
        $isLeader = $request->isLeader;

        $member = lombaMember::create([
            "team_id" => $team_id,
            "role" => $role,
            "isLeader" => $isLeader
        ]);

        return response()->json([
            "success" => true,
            "status_code" => 200,
            "message" => "Berhasil menambahkan data lomba member",
            "data" => $member
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(lombaMember $lombaMember)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(lombaMember $lombaMember)
    {
        //
    }

    /**
     * Update Lomba Member
     * @OA\Put(
     *     security={{"bearerAuth":{}}},
     *     path="/api/lombaMember/{id_member}",
     *     tags={"Lomba Member"},
     *     operationId="lombaMember-update",
     *     summary="Update Lomba Member",
     *     description="Mengubah data Lomba Member",
     *     @OA\Parameter(   
     *         name="id_member",
     *         in="path",
     *         description="Member ID",
     *         example = 1,
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="role",
     *         in="query",
     *         description="Role Name",
     *         example = "Hacker",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="isLeader",
     *         in="query",
     *         description="Apakah Leader",
     *         example = false,
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
     *                 "message": "Berhasil mengubah data lomba member",
     *                 "data": {
     *                      "id_member": 1,
     *                      "team_id": 1,
     *                      "role": "hacker",
     *                      "isLeader": false
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
     * )
     */
    public function update(UpdatelombaMemberRequest $request, lombaMember $lombaMember, $id_member)
    {
        $request->validate([
            "role" => ["required", "string", "max:255"],
            "isLeader" => ["required", "boolean"]
        ]);
        $role = $request->role;
        $isLeader = $request->isLeader;

        $member = $lombaMember::findOrFail($id_member);

        $member->update([
            "role" => $role,
            "isLeader" => $isLeader
        ]);

        return response()->json([
            "success" => true,
            "status_code" => 200,
            "message" => "Berhasil mengubah data member lomba",
            "data" => $member
        ]);
    }

    /**
     * Delete Lomba Member
     * @OA\Delete(
     *     security={{"bearerAuth":{}}},
     *     path="/api/lombaMember/{id_member}",
     *     tags={"Lomba Member"},
     *     operationId="lombaMember-delete",
     *     summary="Menghapus Lomba Member",
     *     description="Menghapus data Lomba Member",
     *     @OA\Parameter(   
     *         name="id_member",
     *         in="path",
     *         description="Member ID",
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
     *                 "message": "Berhasil menghapus data lomba",
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
     * )
     */
    public function destroy(lombaMember $lombaMember, $id_member)
    {
        $member = $lombaMember::findOrFail($id_member);
        $member->delete();

        return response()->json([
            "success" => true,
            "status_code" => 200,
            "message" => "Berhasil menghapus data member lomba",
        ]);
    }
}
