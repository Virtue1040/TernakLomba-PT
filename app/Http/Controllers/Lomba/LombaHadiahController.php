<?php

namespace App\Http\Controllers\Lomba;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lomba\StorelombaHadiahRequest;
use App\Http\Requests\Lomba\UpdatelombaHadiahRequest;
use App\Models\Lomba;
use App\Models\lombaHadiah;
use App\Models\typeHadiah;

class LombaHadiahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Get All Lomba Hadiah
     * @OA\Get(
     *     security={{"bearerAuth":{}}},
     *     path="/api/v1/lombaHadiah",
     *     tags={"Lomba Hadiah"},
     *     operationId="lombaHadiah-all",
     *     summary="Get All Lomba Hadiah",
     *     description="Mengambil Semua data Lomba Hadiah",
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "status_code": 200,
     *                 "message": "Berhasil mengambil data lomba hadiah",
     *                 "data": {
     *                      {
     *                      "lomba_id": 1,
     *                      "typeHadiah_id": 1,
     *                      "quantity": 1
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
        $lombaHadiah = lombaHadiah::all();
        return response()->json([
            'success' => true,
            'status_code' => 200,
            'message' => "Berhasil mengambil data lomba hadiah",
            'data' => $lombaHadiah
        ]);
    }

    /**
     * Get One Lomba Hadiah
     * @OA\Get(
     *     security={{"bearerAuth":{}}},
     *     path="/api/v1/lombaHadiah/get/{id_hadiah}",
     *     tags={"Lomba Hadiah"},
     *     operationId="lombaHadiah-get",
     *     summary="Get One Lomba Hadiah",
     *     description="Mengambil data Lomba Hadiah",
     *     @OA\Parameter(
     *         name="id_hadiah",
     *         in="path",
     *         description="Lomba Hadiah ID",
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
     *                 "message": "Berhasil mengambil data lomba hadiah",
     *                 "data": {
     *                      "lomba_id": 1,
     *                      "typeHadiah_id": 1,
     *                      "quantity": 1
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
    public function get(lombaHadiah $lombaHadiah, $id_hadiah)
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
     * Store Lomba Hadiah
     * @OA\Post(
     *     security={{"bearerAuth":{}}},
     *     path="/api/v1/lombaHadiah",
     *     tags={"Lomba Hadiah"},
     *     operationId="lombaHadiah-store",
     *     summary="Create Lomba Hadiah",
     *     description="Membuat Lomba Hadiah",
     *     @OA\Parameter(
     *         name="lomba_id",
     *         in="query",
     *         description="Lomba ID",
     *         example = 1,
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="typeHadiah_id",
     *         in="query",
     *         description="Type Hadiah ID",
     *         example = 1,
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="quantity",
     *         in="query",
     *         description="Jumlah",
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
     *                 "message": "Berhasil menambahkan data lomba hadiah",
     *                 "data": {
     *                      "lomba_id": 1,
     *                      "typeHadiah_id": 1,
     *                      "quantity": 1
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
    public function store(StorelombaHadiahRequest $request)
    {
        $request->validate([
            "lomba_id" => ["integer", "required", "exists:".Lomba::class],
            "typeHadiah_id" => ["required", "integer", "exists:".typeHadiah::class],
            "quantity" => ["required", "integer"]
        ]);
        $lomba_id = $request->lomba_id;
        $typeHadiah_id = $request->typeHadiah_id;
        $quantity = $request->quantity;

        $lombaHadiah = lombaHadiah::create([
            "lomba_id" => $lomba_id,
            "typeHadiah_id" => $typeHadiah_id,
            "quantity" => $quantity
        ]);

        return response()->json([
            'success' => true,
            'status_code' => 200,
            'message' => "Berhasil menambahkan data lomba hadiah",
            'data' => $lombaHadiah
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(lombaHadiah $lombaHadiah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(lombaHadiah $lombaHadiah)
    {
        //
    }

    /**
     * Update Lomba Hadiah
     * @OA\Put(
     *     security={{"bearerAuth":{}}},
     *     path="/api/v1/lombaHadiah/{id_hadiah}",
     *     tags={"Lomba Hadiah"},
     *     operationId="lombaHadiah-update",
     *     summary="Update Lomba Hadiah",
     *     description="Mengubah data Lomba Hadiah",
     *     @OA\Parameter(
     *         name="id_hadiah",
     *         in="path",
     *         description="Lomba Hadiah ID",
     *         example = 1,
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="typeHadiah_id",
     *         in="query",
     *         description="Type Hadiah ID",
     *         example = 1,
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="quantity",
     *         in="query",
     *         description="Jumlah",
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
     *                 "message": "Berhasil mengubah data lomba hadiah",
     *                 "data": {
     *                      "lomba_id": 1,
     *                      "typeHadiah_id": 1,
     *                      "quantity": 1
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
    public function update(UpdatelombaHadiahRequest $request, lombaHadiah $lombaHadiah, $id_hadiah)
    {
        $request->validate([
            "typeHadiah_id" => ["required", "integer", "exists:".typeHadiah::class],
            "quantity" => ["required", "integer"]
        ]);
        $typeHadiah_id = $request->typeHadiah_id;
        $quantity = $request->quantity;

        $lombaHadiah = $lombaHadiah::findOrFail($id_hadiah);
        $lombaHadiah->typeHadiah_id = $typeHadiah_id;
        $lombaHadiah->quantity = $quantity;
        $lombaHadiah->save();

        return response()->json([
            'success' => true,
            'status_code' => 200,
            'message' => "Berhasil mengubah data lomba hadiah",
            'data' => $lombaHadiah
        ]);
    }

    /**
     * Delete Lomba Hadiah
     * @OA\Delete(
     *     security={{"bearerAuth":{}}},
     *     path="/api/v1/lombaHadiah/{id_hadiah}",
     *     tags={"Lomba Hadiah"},
     *     operationId="lombaHadiah-delete",
     *     summary="Delete Lomba Hadiah",
     *     description="Menghapus data Lomba Hadiah",
     *     @OA\Parameter(
     *         name="id_hadiah",
     *         in="path",
     *         description="Lomba Hadiah ID",
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
     *                 "message": "Berhasil menghapus data lomba hadiah",
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
    public function destroy(lombaHadiah $lombaHadiah, $id_hadiah)
    {
        $lombaHadiahs = $lombaHadiah::findOrFail($id_hadiah);
        $lombaHadiahs->delete();

        return response()->json([
            "success" => true,
            "status_code" => 200,
            "message" => "Berhasil menghapus data lomba hadiah",
        ], 200);
    }
}
