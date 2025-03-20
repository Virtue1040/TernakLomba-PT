<?php

namespace App\Http\Controllers\Lomba;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lomba\StoreLombaRequest;
use App\Http\Requests\Lomba\UpdateLombaRequest;
use App\Models\Lomba;
use App\Models\Lomba_detail;

class LombaController extends Controller
{
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
     * Store Lomba
     * @OA\Post(
     *     security={{"bearerAuth":{}}},
     *     path="/api/lomba",
     *     tags={"Lomba"},
     *     operationId="lomba-store",
     *     summary="Create Lomba",
     *     description="Membuat Lomba",
     *     @OA\Parameter(
     *         name="max_member",
     *         in="query",
     *         description="Maximal Member",
     *         example = 1,
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(   
     *         name="min_member",
     *         in="query",
     *         description="Minimal Member",
     *         example = 1,
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="title",
     *         in="query",
     *         description="Title Lomba",
     *         example = "Gemastik",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="description",
     *         in="query",
     *         description="Description Lomba",
     *         example = "Lomba Adalah",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="lombaCategory_id",
     *         in="query",
     *         description="Category ID",
     *         example = 1,
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="start_date",
     *         in="query",
     *         description="Start Date",
     *         example = "2025-03-20 23:01:22",
     *         required=true,
     *         @OA\Schema(type="string", format="date")
     *     ),
     *     @OA\Parameter(
     *         name="end_date",
     *         in="query",
     *         description="End Date",
     *         example = "2025-03-20 23:01:22",
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
     *                 "message": "Berhasil menambahkan data lomba",
     *                 "data": {
     *                      "lomba": {
     *                      "max_member": 1,
     *                      "min_member": 1,
     *                      "lombaCategory_id": 1,
     *                      "start_date": "2025-03-20 23:01:22",
     *                      "end_date": "2025-03-20 23:01:22",
     *                      "updated_at": "2025-03-20T16:04:14.000000Z",
     *                      "created_at": "2025-03-20T16:04:14.000000Z",
     *                      "id_lomba": 2
     *                      },
     *                      "lomba_detail": {
     *                      "lomba_id": 2,
     *                      "title": "Gemastik",
     *                      "description": "Lomba Adalah",
     *                      "updated_at": "2025-03-20T16:04:14.000000Z",
     *                      "created_at": "2025-03-20T16:04:14.000000Z"
     *                      }
     *                  }
     *             }
     *         ),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Error: Unauthorized",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "status_code": 401,
     *                 "message": "Unauthorized"
     *             }
     *         ),
     *     ),
     * )
     */
    public function store(StoreLombaRequest $request)
    {
        $request->validate([
            "max_member" => ["required", "integer", "min:1"],
            "min_member" => ["required", "integer", "min:1"],
            "title" => ["required", "string", "max:255"],
            "description" => ["required", "string", "max:255"],
            "lombaCategory_id" => ["required", "integer", "exists:lomba_categories,id_lombaCategory"],
            "start_date" => ["required", "date_format:Y-m-d H:i:s"],
            "end_date" => ["required", "date_format:Y-m-d H:i:s"]
        ]);

        $max_member = $request->max_member;
        $min_member = $request->min_member;
        $title = $request->title;
        $description = $request->description;
        $lombaCategory_id = $request->lombaCategory_id;


        $lomba = Lomba::create([
            "max_member" => $max_member ,
            "min_member" => $min_member,
            "lombaCategory_id" => $lombaCategory_id,
            "start_date" => $request->start_date,
            "end_date" => $request->end_date
        ]);

        $lomba_detail = Lomba_detail::create([
            "lomba_id" => $lomba->id_lomba,
            "title" => $title,
            "description" => $description
        ]);

        return response()->json([
            "success" => true,
            "status_code" => 200,
            "message" => "Berhasil menambahkan data lomba",
            "data" => [
                "lomba" => $lomba,
                "lomba_detail" => $lomba_detail
            ]
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Lomba $lomba)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lomba $lomba)
    {
        //
    }

    /**
     * Update Lomba
     * @OA\Put(
     *     security={{"bearerAuth":{}}},
     *     path="/api/lomba/{id_lomba}",
     *     tags={"Lomba"},
     *     operationId="lomba-update",
     *     summary="Update Lomba",
     *     description="Mengubah data Lomba",
     *     @OA\Parameter(
     *         name="id_lomba",
     *         in="path",
     *         description="Lomba ID",
     *         example = 1,
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="max_member",
     *         in="query",
     *         description="Maximal Member",
     *         example = 1,
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(   
     *         name="min_member",
     *         in="query",
     *         description="Minimal Member",
     *         example = 1,
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="title",
     *         in="query",
     *         description="Title Lomba",
     *         example = "Gemastik",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="description",
     *         in="query",
     *         description="Description Lomba",
     *         example = "Lomba Adalah",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="lombaCategory_id",
     *         in="query",
     *         description="Category ID",
     *         example = 1,
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="start_date",
     *         in="query",
     *         description="Start Date",
     *         example = "2025-03-20 23:01:22",
     *         required=true,
     *         @OA\Schema(type="string", format="date")
     *     ),
     *     @OA\Parameter(
     *         name="end_date",
     *         in="query",
     *         description="End Date",
     *         example = "2025-03-20 23:01:22",
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
     *                 "message": "Berhasil mengubah data lomba",
     *                 "data": {
     *                      "lomba": {
     *                      "max_member": 1,
     *                      "min_member": 1,
     *                      "lombaCategory_id": 1,
     *                      "start_date": "2025-03-20 23:01:22",
     *                      "end_date": "2025-03-20 23:01:22",
     *                      "updated_at": "2025-03-20T16:04:14.000000Z",
     *                      "created_at": "2025-03-20T16:04:14.000000Z",
     *                      "id_lomba": 2
     *                      },
     *                      "lomba_detail": {
     *                      "lomba_id": 2,
     *                      "title": "Gemastik",
     *                      "description": "Lomba Adalah",
     *                      "updated_at": "2025-03-20T16:04:14.000000Z",
     *                      "created_at": "2025-03-20T16:04:14.000000Z"
     *                      }
     *                  }
     *             }
     *         ),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Error: Unauthorized",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "status_code": 401,
     *                 "message": "Unauthorized"
     *             }
     *         ),
     *     ),
     * )
     */
    public function update(UpdateLombaRequest $request, Lomba $lomba)
    {
        //
    }

    /**
     * Delete Lomba
     * @OA\Delete(
     *     security={{"bearerAuth":{}}},
     *     path="/api/lomba/{id_lomba}",
     *     tags={"Lomba"},
     *     operationId="lomba-delete",
     *     summary="Delete Lomba",
     *     description="Menghapus data Lomba",
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
     *                 "message": "Berhasil mengubah data lomba",
     *             }
     *         ),
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="Error: Unauthorized",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "status_code": 401,
     *                 "message": "Unauthorized"
     *             }
     *         ),
     *     ),
     * )
     */
    public function destroy(Lomba $lomba)
    {
        //
    }
}
