<?php

namespace App\Http\Controllers\Lomba;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lomba\StoreLombaRequest;
use App\Http\Requests\Lomba\UpdateLombaRequest;
use App\Models\bidangMinat;
use App\Models\Lomba;
use App\Models\Lomba_detail;
use Auth;

class LombaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:lomba-read', ['only' => ['index', 'show']]);
        // $this->middleware('permission:lomba-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:lomba-approve', ['only' => ['approver', 'approve']]);
        $this->middleware('permission:lomba-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:lomba-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        //
    }

    /**
     * Get All Lomba
     * @OA\Get(
     *     security={{"bearerAuth":{}}},
     *     path="/api/v1/lomba",
     *     tags={"Lomba"},
     *     operationId="lomba-all",
     *     summary="Get All Lomba",
     *     description="Mengambil Semua data Lomba",
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "status_code": 200,
     *                 "message": "Berhasil mengambil data lomba",
     *                 "data": {
     *                      {
     *                      "lomba": {
     *                      "max_member": 1,
     *                      "min_member": 1,
     *                      "lombaCategory_id": 1,
     *                      "start_date": "2025-03-20",
     *                      "end_date": "2025-03-20",
     *                      "decide_date": "2025-03-20",
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
     * Get One Lomba
     * @OA\Get(
     *     security={{"bearerAuth":{}}},
     *     path="/api/v1/lomba/get/{id_lomba}",
     *     tags={"Lomba"},
     *     operationId="lomba-get",
     *     summary="Get One Lomba",
     *     description="Mengambil data Lomba",
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
     *                 "message": "Berhasil mengambil data lomba",
     *                 "data": {
     *                      "max_member": 1,
     *                      "min_member": 1,
     *                      "lombaCategory_id": 1,
     *                      "start_date": "2025-03-20",
     *                      "end_date": "2025-03-20",
     *                      "decide_date": "2025-03-20",
     *                      "updated_at": "2025-03-20T16:04:14.000000Z",
     *                      "created_at": "2025-03-20T16:04:14.000000Z",
     *                      "id_lomba": 2
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
        $listMinat = bidangMinat::all();
        return view("display.registData.lomba.index", ['listMinat' => $listMinat]);
    }

    /**
     * Store Lomba
     * @OA\Post(
     *     security={{"bearerAuth":{}}},
     *     path="/api/v1/lomba",
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
     *         name="roleList",
     *         in="query",
     *         description="List Role (dipisah dengan ',')",
     *         example="Leader,Hacker",
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
     *         example = "2025-03-20",
     *         required=true,
     *         @OA\Schema(type="string", format="date")
     *     ),
     *     @OA\Parameter(
     *         name="end_date",
     *         in="query",
     *         description="End Date",
     *         example = "2025-03-20",
     *         required=true,
     *         @OA\Schema(type="string", format="date")
     *     ),
     *     @OA\Parameter(
     *         name="decide_date",
     *         in="query",
     *         description="Decide Date",
     *         example = "2025-03-21",
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
     *                      "start_date": "2025-03-20",
     *                      "end_date": "2025-03-20",
     *                      "decide_date": "2025-03-21",
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
    public function store(StoreLombaRequest $request)
    {
        $request->validate([
            "max_member" => ["required", "integer", "min:1"],
            "min_member" => ["required", "integer", "min:1"],
            "title" => ["required", "string", "max:255"],
            "description" => ["required", "string", "max:255"],
            "roleList" => ["required"],
            "lombaCategory_id" => ["required", "integer", "exists:lomba_categories,id_lombaCategory"],
            "start_date" => ["required", "date_format:Y-m-d"],
            "end_date" => ["required", "date_format:Y-m-d"],
            "decide_date" => ["required", "date_format:Y-m-d"]
        ]);
        $max_member = $request->max_member;
        $min_member = $request->min_member;
        $title = $request->title;
        $description = $request->description;
        $lombaCategory_id = $request->lombaCategory_id;
        $roleList = explode(',', $request->input('roleList', ''));
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $decide_date = $request->decide_date;

        $lomba = Lomba::create([
            "max_member" => $max_member,
            "min_member" => $min_member,
            "lombaCategory_id" => $lombaCategory_id,
            "roleList" => $request->roleList,
            "created_by" => Auth::user()->id_user,
            "start_date" => $start_date,
            "end_date" => $end_date,
            "decide_date" => $decide_date
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
     *     path="/api/v1/lomba/{id_lomba}",
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
    public function update(UpdateLombaRequest $request, Lomba $lomba, $id_lomba)
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

        $lomba = $lomba::findOrFail($id_lomba);
        $lomba->max_member = $max_member;
        $lomba->min_member = $min_member;
        $lomba->lombaCategory_id = $lombaCategory_id;
        $lomba->start_date = $request->start_date;
        $lomba->end_date = $request->end_date;

        $lomba_detail = $lomba->lomba_detail;
        $lomba_detail->title = $title;
        $lomba_detail->description = $description;

        $lomba->save();
        $lomba_detail->save();

        return response()->json([
            "success" => true,
            "status_code" => 200,
            "message" => "Berhasil mengubah data lomba",
            "data" => [
                "lomba" => $lomba,
                "lomba_detail" => $lomba_detail
            ]
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function approver(Lomba $lomba)
    {
        //
    }

    /**
     * Approve Lomba
     * @OA\Post(
     *     security={{"bearerAuth":{}}},
     *     path="/api/v1/lomba/{id_lomba}",
     *     tags={"Lomba"},
     *     operationId="lomba-approve",
     *     summary="Approve Lomba",
     *     description="Approve data Lomba",
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
     *                 "message": "Berhasil mengapprove lomba",
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
    public function approve(UpdateLombaRequest $request, Lomba $lomba, $id_lomba)
    {
        $lomba = $lomba::findOrFail($id_lomba);
        $lomba->isApproved = true;
        $lomba->save();

        return response()->json([
            "success" => true,
            "status_code" => 200,
            "message" => "Berhasil mengapprove lomba",
        ], 200);
    }

    /**
     * Delete Lomba
     * @OA\Delete(
     *     security={{"bearerAuth":{}}},
     *     path="/api/v1/lomba/{id_lomba}",
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
    public function destroy(Lomba $lomba, $id_lomba)
    {
        $lombas = $lomba::findOrFail($id_lomba);
        $lombas->delete();

        return response()->json([
            "success" => true,
            "status_code" => 200,
            "message" => "Berhasil menghapus data lomba",
        ], 200);
    }
}
