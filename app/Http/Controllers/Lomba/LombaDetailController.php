<?php

namespace App\Http\Controllers\Lomba;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lomba\StoreLomba_detailRequest;
use App\Http\Requests\Lomba\UpdateLomba_detailRequest;
use App\Models\Lomba_detail;

class LombaDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Get All Lomba Detail
     * @OA\Get(
     *     security={{"bearerAuth":{}}},
     *     path="/api/lombaDetail",
     *     tags={"Lomba Detail"},
     *     operationId="lombaDetail-all",
     *     summary="Get All Lomba Detail",
     *     description="Mengambil Semua data Lomba Detail",
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "status_code": 200,
     *                 "message": "Berhasil mengambil data lomba detail",
     *                 "data": {
     *                       {
     *                      "lomba_id": 1,
     *                      "title": "Gemastik",
     *                      "description": "Lomba Adalah",
     *                      "created_at": "2025-03-20T17:31:27.000000Z",
     *                      "updated_at": "2025-03-20T17:31:27.000000Z"
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
        $lomba_detail = Lomba_detail::all();
        return response()->json([
            'success' => true,
            'status_code' => 200,
            'message' => "Berhasil mengambil data lomba detail",
            'data' => $lomba_detail
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLomba_detailRequest $request)
    {
        //
    }

    /**
     * Get One Lomba Detail
     * @OA\Get(
     *     security={{"bearerAuth":{}}},
     *     path="/api/lombaDetail/get/{id_lomba}",
     *     tags={"Lomba Detail"},
     *     operationId="lombaDetail-get",
     *     summary="Get One Lomba Detail",
     *     description="Mengambil data Lomba Detail",
     *     @OA\Parameter(
     *         name="id_lomba",
     *         in="path",
     *         description="Lomba ID",
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
     *                 "message": "Berhasil mengambil data lomba detail",
     *                 "data": {
     *                      "lomba_id": 1,
     *                      "title": "Gemastik",
     *                      "description": "Lomba Adalah",
     *                      "created_at": "2025-03-20T17:31:27.000000Z",
     *                      "updated_at": "2025-03-20T17:31:27.000000Z"
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
    public function get(Lomba_detail $lomba_detail, $id_lomba)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lomba_detail $lomba_detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLomba_detailRequest $request, Lomba_detail $lomba_detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lomba_detail $lomba_detail)
    {
        //
    }
}
