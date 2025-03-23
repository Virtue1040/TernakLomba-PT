<?php

namespace App\Http\Controllers\Lomba;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lomba\StorelombaAlbumRequest;
use App\Http\Requests\Lomba\UpdatelombaAlbumRequest;
use App\Models\Lomba;
use App\Models\lombaAlbum;

class LombaAlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    
    /**
     * Get All Lomba Album
     * @OA\Get(
     *     security={{"bearerAuth":{}}},
     *     path="/api/lombaAlbum",
     *     tags={"Lomba Album"},
     *     operationId="lombaAlbum-all",
     *     summary="Get All Lomba Album",
     *     description="Mengambil Semua data Lomba Album",
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "status_code": 200,
     *                 "message": "Berhasil mengambil data lomba album",
     *                 "data": {
     *                      {
     *                      "lomba_id": 1,
     *                      "title": "Cover",
     *                      "imagePath": "/src/a.png"
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
        $lombaAlbum = lombaAlbum::all();
        return response()->json([
            'success' => true,
            'status_code' => 200,
            'message' => "Berhasil mengambil data lomba album",
            'data' => $lombaAlbum
        ]);
    }

    /**
     * Get One Lomba Album
     * @OA\Get(
     *     security={{"bearerAuth":{}}},
     *     path="/api/lombaAlbum/get/{id_lombaAlbum}",
     *     tags={"Lomba Album"},
     *     operationId="lombaAlbum-get",
     *     summary="Get One Lomba Album",
     *     description="Mengambil data Lomba Album",
     *     @OA\Parameter(
     *         name="id_lombaAlbum",
     *         in="path",
     *         description="Lomba Album ID",
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
     *                 "message": "Berhasil mengambil data lomba album",
     *                 "data": {
     *                      "lomba_id": 1,
     *                      "title": "Cover",
     *                      "imagePath": "/src/a.png"
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
    public function get(lombaAlbum $lombaAlbum, $id_lombaAlbum)
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
     * Store Lomba Album
     * @OA\Post(
     *     security={{"bearerAuth":{}}},
     *     path="/api/lombaAlbum",
     *     tags={"Lomba Album"},
     *     operationId="lombaAlbum-store",
     *     summary="Create Lomba Album",
     *     description="Membuat Lomba Album",
     *     @OA\Parameter(
     *         name="lomba_id",
     *         in="query",
     *         description="Lomba ID",
     *         example = 1,
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="title",
     *         in="query",
     *         description="Title Album",
     *         example = "Cover",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="imagePath",
     *         in="query",
     *         description="Image Path",
     *         example = "/src/a.png",
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
     *                      "title": "Cover",
     *                      "imagePath": "/src/a.png"
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
    public function store(StorelombaAlbumRequest $request)
    {
        $request->validate([
            "lomba_id" => ["integer", "required", "exists:".Lomba::class],
            "title" => ["required", "string"],
            "imagePath" => ["required", "string"]
        ]);
        $lomba_id = $request->lomba_id;
        $title = $request->title;
        $imagePath = $request->imagePath;

        $lombaAlbum = lombaAlbum::create([
            "lomba_id" => $lomba_id,
            "title" => $title,
            "imagePath" => $imagePath
        ]);

        return response()->json([
            'success' => true,
            'status_code' => 200,
            'message' => "Berhasil menambahkan data lomba album",
            'data' => $lombaAlbum
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(lombaAlbum $lombaAlbum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(lombaAlbum $lombaAlbum)
    {
        //
    }

    /**
     * Update Lomba Album
     * @OA\Put(
     *     security={{"bearerAuth":{}}},
     *     path="/api/lombaAlbum/{id_lombaAlbum}",
     *     tags={"Lomba Album"},
     *     operationId="lombaAlbum-update",
     *     summary="Update Lomba Album",
     *     description="Mengubah data Lomba Album",
     *     @OA\Parameter(
     *         name="id_lombaAlbum",
     *         in="path",
     *         description="Lomba Album ID",
     *         example = 1,
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="title",
     *         in="query",
     *         description="Title Album",
     *         example = "Cover",
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
     *                 "message": "Berhasil mengubah data lomba hadiah",
     *                 "data": {
     *                      "lomba_id": 1,
     *                      "title": "Cover",
     *                      "imagePath": "/src/a.png"
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
    public function update(UpdatelombaAlbumRequest $request, lombaAlbum $lombaAlbum, $id_lombaAlbum)
    {
        $request->validate([
            "title" => ["required", "string"],
            "imagePath" => ["required", "string"]
        ]);
        $title = $request->title;
        $imagePath = $request->imagePath;

        $lombaAlbum = $lombaAlbum::findOrFail($id_lombaAlbum);
        $lombaAlbum->title = $title;
        $lombaAlbum->imagePath = $imagePath;
        $lombaAlbum->save();

        return response()->json([
            'success' => true,
            'status_code' => 200,
            'message' => "Berhasil mengubah data lomba album",
            'data' => $lombaAlbum
        ]);
    }

    /**
     * Delete Lomba Album
     * @OA\Delete(
     *     security={{"bearerAuth":{}}},
     *     path="/api/lombaAlbum/{id_lombaAlbum}",
     *     tags={"Lomba Album"},
     *     operationId="lombaAlbum-delete",
     *     summary="Delete Lomba Album",
     *     description="Menghapus data Lomba Album",
     *     @OA\Parameter(
     *         name="id_lombaAlbum",
     *         in="path",
     *         description="Lomba Album ID",
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
     *                 "message": "Berhasil menghapus data lomba album",
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
    public function destroy(lombaAlbum $lombaAlbum, $id_lombaAlbum)
    {
        $lombaAlbums = $lombaAlbum::findOrFail($id_lombaAlbum);
        $lombaAlbums->delete();

        return response()->json([
            "success" => true,
            "status_code" => 200,
            "message" => "Berhasil menghapus data lomba album",
        ], 200);
    }
}
