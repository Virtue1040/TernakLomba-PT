<?php

namespace App\Http\Controllers\Lomba;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoretypeHadiahRequest;
use App\Http\Requests\UpdatetypeHadiahRequest;
use App\Models\Lomba;
use App\Models\typeHadiah;

class TypeHadiahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Get All Type Hadiah
     * @OA\Get(
     *     security={{"bearerAuth":{}}},
     *     path="/api/v1/typeHadiah",
     *     tags={"Type Hadiah"},
     *     operationId="typeHadiah-all",
     *     summary="Get All Type Hadiah",
     *     description="Mengambil Semua data Type Hadiah",
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "status_code": 200,
     *                 "message": "Berhasil mengambil data type hadiah",
     *                 "data": {
     *                      {
     *                      "lomba_id": 1,
     *                      "name": "TV"
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
        $lomba = Lomba::all();
        return response()->json([
            'success' => true,
            'status_code' => 200,
            'message' => "Berhasil mengambil data lomba",
            'data' => $lomba
        ]);
    }

    /**
     * Get One Type Hadiah
     * @OA\Get(
     *     security={{"bearerAuth":{}}},
     *     path="/api/v1/typeHadiah/get/{id_typeHadiah}",
     *     tags={"Type Hadiah"},
     *     operationId="typeHadiah-get",
     *     summary="Get One Type Hadiah",
     *     description="Mengambil data Type Hadiah",
     *     @OA\Parameter(
     *         name="id_typeHadiah",
     *         in="path",
     *         description="Type Hadiah ID",
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
     *                 "message": "Berhasil mengambil data type hadiah",
     *                 "data": {
     *                      "lomba_id": 1,
     *                      "name": "TV"
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
    public function get(Lomba $lomba, $id_lomba)
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
     * Store Type Hadiah
     * @OA\Post(
     *     security={{"bearerAuth":{}}},
     *     path="/api/v1/typeHadiah",
     *     tags={"Type Hadiah"},
     *     operationId="typeHadiah-store",
     *     summary="Create Type Hadiah",
     *     description="Membuat Type Hadiah",
     *     @OA\Parameter(
     *         name="lomba_id",
     *         in="query",
     *         description="Lomba ID",
     *         example = 1,
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Hadiah Name",
     *         example = "TV",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "status_code": 200,
     *                 "message": "Berhasil menambahkan data type hadiah",
     *                 "data": {
     *                      "lomba_id": 1,
     *                      "name": "TV"
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
    public function store(StoretypeHadiahRequest $request)
    {
        $request->validate([
            "lomba_id" => ["integer", "nullable", "exists:".Lomba::class],
            "name" => ["required", "string", "max:255", "unique:".typeHadiah::class],
        ]);
        $lomba_id = $request->lomba_id;
        $name = $request->name;

        $typeHadiah = typeHadiah::create([
            "lomba_id" => $lomba_id,
            "name" => $name,
        ]);

        return response()->json([
            'success' => true,
            'status_code' => 200,
            'message' => "Berhasil menambahkan data type hadiah",
            'data' => $typeHadiah
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(typeHadiah $typeHadiah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(typeHadiah $typeHadiah)
    {

    }

    /**
     * Update Type Hadiah
     * @OA\Put(
     *     security={{"bearerAuth":{}}},
     *     path="/api/v1/typeHadiah/{id_typeHadiah}",
     *     tags={"Type Hadiah"},
     *     operationId="typeHadiah-update",
     *     summary="Create Type Hadiah",
     *     description="Membuat Type Hadiah",
     *     @OA\Parameter(
     *         name="id_typeHadiah",
     *         in="path",
     *         description="Type Hadiah ID",
     *         example = 1,
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Hadiah Name",
     *         example = "TV",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "status_code": 200,
     *                 "message": "Berhasil mengubah data type hadiah",
     *                 "data": {
     *                      "lomba_id": 1,
     *                      "name": "TV"
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
    public function update(UpdatetypeHadiahRequest $request, typeHadiah $typeHadiah, $id_typeHadiah)
    {
        $request->validate([
            "name" => ["required", "string", "max:255", "unique:".typeHadiah::class],
        ]);
        $name = $request->name;

        $typeHadiah = $typeHadiah::findOrFail($id_typeHadiah);
        $typeHadiah->name = $name;
        $typeHadiah->save();

        return response()->json([
            'success' => true,
            'status_code' => 200,
            'message' => "Berhasil menambahkan data type hadiah",
            'data' => $typeHadiah
        ]);
    }

    /**
     * Delete Type Hadiah
     * @OA\Delete(
     *     security={{"bearerAuth":{}}},
     *     path="/api/v1/typeHadiah/{id_typeHadiah}",
     *     tags={"Type Hadiah"},
     *     operationId="typeHadiah-delete",
     *     summary="Delete Type Hadiah",
     *     description="Menghapus data Type Hadiah",
     *     @OA\Parameter(
     *         name="id_typeHadiah",
     *         in="path",
     *         description="Type Hadiah ID",
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
     *                 "message": "Berhasil menghapus data type hadiah",
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
    public function destroy(typeHadiah $typeHadiah, $id_typeHadiah)
    {
        $typeHadiahs = $typeHadiah::findOrFail($id_typeHadiah);
        $typeHadiahs->delete();

        return response()->json([
            "success" => true,
            "status_code" => 200,
            "message" => "Berhasil menghapus data type hadiah",
        ], 200);
    }
}
