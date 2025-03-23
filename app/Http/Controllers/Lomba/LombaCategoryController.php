<?php

namespace App\Http\Controllers\Lomba;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lomba\StorelombaCategoryRequest;
use App\Http\Requests\Lomba\UpdatelombaCategoryRequest;
use App\Models\lombaCategory;

class LombaCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Get All Lomba Category
     * @OA\Get(
     *     security={{"bearerAuth":{}}},
     *     path="/api/lombaCategory",
     *     tags={"Lomba Category"},
     *     operationId="lombaCategory-all",
     *     summary="Get All Lomba Category",
     *     description="Mengambil Semua data Category Lomba",
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "status_code": 200,
     *                 "message": "Berhasil mengambil data category lomba",
     *                 "data": {
     *                      {
     *                          "name": "University",
     *                          "updated_at": "2025-03-20T17:11:42.000000Z",
     *                          "created_at": "2025-03-20T17:11:42.000000Z",
     *                          "id_lombaCategory": 1
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
        $category = lombaCategory::all();
        return response()->json([
            'success' => true,
            'status_code' => 200,
            'message' => "Berhasil mengambil data category lomba",
            'data' => $category
        ]);
    }

    /**
     * Get One Lomba Category
     * @OA\Get(
     *     security={{"bearerAuth":{}}},
     *     path="/api/lombaCategory/get/{id_lombaCategory}",
     *     tags={"Lomba Category"},
     *     operationId="lombaCategory-get",
     *     summary="Get One Lomba Category",
     *     description="Mengambil data Lomba Category",
     *     @OA\Parameter(
     *         name="id_lombaCategory",
     *         in="path",
     *         description="Category ID",
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
     *                 "message": "Berhasil mengambil data lomba category",
     *                 "data": {
     *                          "name": "University",
     *                          "updated_at": "2025-03-20T17:11:42.000000Z",
     *                          "created_at": "2025-03-20T17:11:42.000000Z",
     *                          "id_lombaCategory": 1
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
    public function get(lombaCategory $lombaCategory, $id_lomba)
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
     * Store Lomba Category
     * @OA\Post(
     *     security={{"bearerAuth":{}}},
     *     path="/api/lombaCategory",
     *     tags={"Lomba Category"},
     *     operationId="lombaCategory-create",
     *     summary="Create Lomba Category",
     *     description="Membuat Category Lomba",
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Category Name",
     *         example = "University",
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
     *                 "message": "Berhasil menambahkan data category lomba",
     *                 "data": {
     *                          "name": "University",
     *                          "updated_at": "2025-03-20T17:11:42.000000Z",
     *                          "created_at": "2025-03-20T17:11:42.000000Z",
     *                          "id_lombaCategory": 1
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
    public function store(StorelombaCategoryRequest $request)
    {
        $request->validate([
            "name" => ["required", "string", "max:255", "unique:" . lombaCategory::class]
        ]);
        $name = $request->name;

        $category = lombaCategory::create([
            "name" => $name
        ]);

        return response()->json([
            "success" => true,
            "status_code" => 200,
            "message" => "Berhasil menambahkan data lomba",
            "data" => $category
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(lombaCategory $lombaCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(lombaCategory $lombaCategory)
    {
        //
    }

    /**
     * Update Lomba Category
     * @OA\Put(
     *     security={{"bearerAuth":{}}},
     *     path="/api/lombaCategory/{id_lombaCategory}",
     *     tags={"Lomba Category"},
     *     operationId="lombaCategory-update",
     *     summary="Update Lomba Category",
     *     description="Mengubah data Category Lomba",
     *     @OA\Parameter(
     *         name="id_lombaCategory",
     *         in="path",
     *         description="Category ID",
     *         example = 1,
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Category Name",
     *         example = "University",
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
     *                 "message": "Berhasil mengubah data category lomba",
     *                 "data": {
     *                          "name": "University",
     *                          "updated_at": "2025-03-20T17:11:42.000000Z",
     *                          "created_at": "2025-03-20T17:11:42.000000Z",
     *                          "id_lombaCategory": 1
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
    public function update(UpdatelombaCategoryRequest $request, lombaCategory $lombaCategory, $id_lombaCategory)
    {
        $request->validate([
            "name" => ["required", "string", "max:255"]
        ]);
        $name = $request->name;

        $category = lombaCategory::findOrFail($id_lombaCategory);

        $category->name = $name;
        $category->save();

        return response()->json([
            "success" => true,
            "status_code" => 200,
            "message" => "Berhasil mengubah data category lomba",
            "data" => $category
        ], 200);
    }

    /**
     * Delete Lomba Category
     * @OA\Delete(
     *     security={{"bearerAuth":{}}},
     *     path="/api/lombaCategory/{id_lombaCategory}",
     *     tags={"Lomba Category"},
     *     operationId="lombaCategory-delete",
     *     summary="Delete Lomba Category",
     *     description="Menghapus data Category Lomba",
     *     @OA\Parameter(
     *         name="id_lombaCategory",
     *         in="path",
     *         description="Category ID",
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
     *                 "message": "Berhasil menghapus data category lomba",
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
    public function destroy(lombaCategory $lombaCategory, $id_lombaCategory)
    {
        $category = $lombaCategory::findOrFail($id_lombaCategory);
        $category->delete();

        return response()->json([
            "success" => true,
            "status_code" => 200,
            "message" => "Berhasil menghapus data category lomba",
        ], 200);
    }
}
