<?php

namespace App\Http\Controllers\Lomba;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lomba\StoreLombaRequest;
use App\Http\Requests\Lomba\UpdateLombaRequest;
use App\Models\bidangMinat;
use App\Models\Lomba;
use App\Models\Lomba_detail;
use App\Models\lombaCategory;
use App\Models\lombaHadiah;
use App\Models\lombaTeam;
use File;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LombaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:lomba-read', ['only' => ['index']]);
        // $this->middleware('permission:lomba-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:lomba-approve', ['only' => ['approver', 'approve']]);
        $this->middleware('permission:lomba-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:lomba-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $lombas = Lomba::where("isApproved", 1)->get();

        $users = User::with(['detail', 'mahasiswa', 'prestasi'])
        ->where('id_user', '!=', auth("sanctum")->user()->id_user)
        ->get();

        return view('display.dashboard.explore.index', compact('lombas','users'));
    }

    public function admin() {
        $lombas = Lomba::all();
        $lombaTeams = lombaTeam::all();
        return view('display.dashboard.admin-dashboard.index',  ["lombas" => $lombas, 'lombaTeams' => $lombaTeams]);
    }

    public function compspace($id_lomba) {
        $lomba = Lomba::findOrFail($id_lomba);
        return view('display.Team.searchTeam', ["lomba" => $lomba]);
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
    public function get(Lomba $lomba, $id_lomba) {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listMinat = bidangMinat::all();
        $listCategory = lombaCategory::all();
        return view("display.registData.lomba.index", ['listMinat' => $listMinat, 'listCategory' => $listCategory]);
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
     *         name="cost_PerTeam",
     *         in="query",
     *         description="Pembagian biaya per anggota",
     *         example = 10000,
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     * @OA\Parameter(
     *     name="competitionLevel",
     *     in="query",
     *     description="Tingkatan level lomba",
     *     required=true,
     *     @OA\Schema(
     *         type="string",
     *         enum={"Internasional", "Nasional", "Regional"},
     *         example="Internasional"
     *     )
     * ),
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
     *         name="total_hadiah",
     *         in="query",
     *         description="Total Hadiah Lomba",
     *         example = 100000,
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="total_juara",
     *         in="query",
     *         description="Total Juara Lomba",
     *         example = 1,
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="penyelenggara_name",
     *         in="query",
     *         description="Nama Penyelenggara Lomba",
     *         example = "Udin Santoso",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="pic_name",
     *         in="query",
     *         description="Nama PIC",
     *         example = "Udin",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="pic_tel",
     *         in="query",
     *         description="No Whatsapp PIC",
     *         example = "089123812383",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="pic_email",
     *         in="query",
     *         description="Email PIC",
     *         example = "pic@gmail.com",
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
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"poster_kompetisi","guide_book","preview_foto_kompetisi"},
     *             @OA\Property(
     *                 property="poster_kompetisi",
     *                 description="Poster Kompetisi (Image File max 5MB)",
     *                 type="string",
     *                 format="binary"
     *             ),
     *             @OA\Property(
     *                 property="guide_book",
     *                 description="Guide Book (PDF File max 2MB)",
     *                 type="string",
     *                 format="binary"
     *             ),
     *             @OA\Property(
     *                 property="preview_foto_kompetisi",
     *                 description="Preview Foto Kompetisi (Image File max 5MB)",
     *                 type="string",
     *                 format="binary"
     *             )
     *           )
     *         )
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
     *                      "total_juara": 1,
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
     *                      "penyelenggara_name": "Udin Santoso",
     *                      "pic_name": "Udin",
     *                      "pic_tel": "089123812383",
     *                      "pic_email": "pic@gmail.com",
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
            "roleList" => ["string", "max:255"],
            "lombaCategory_id" => ["required", "integer", "exists:lomba_categories,id_lombaCategory"],
            "start_date" => ["required", "date_format:Y-m-d"],
            "end_date" => ["required", "date_format:Y-m-d"],
            "decide_date" => ["required", "date_format:Y-m-d"],
            "total_hadiah" => ["required", "integer", "min:1"],
            "total_juara" => ["required", "integer", "min:1"],
            "penyelenggara_name" => ["required", "string", "max:255"],
            "pic_name" => ["required", "string", "max:255", "regex:/^[a-zA-Z\s]*$/"],
            "pic_tel" => ["required", "string", "max:50"],
            "pic_email" => ["required", "email", "max:255"],
            "poster_kompetisi" => ["required", "mimes:jpg,png,jpeg", "max:5120"],
            "guide_book" => ["required", "mimes:pdf", "max:2048"],
            "preview_foto_kompetisi" => ["required", "mimes:jpg,png,jpeg", "max:5120"],
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
        $total_hadiah = $request->total_hadiah;
        $total_juara = $request->total_juara;
        $penyelenggara_name = $request->penyelenggara_name;
        $pic_name = $request->pic_name;
        $pic_tel = $request->pic_tel;
        $pic_email = $request->pic_email;
        $poster_kompetisi = $request->poster_kompetisi;
        $guide_book = $request->guide_book;
        $preview_foto_kompetisi = $request->preview_foto_kompetisi;

        $user = auth("sanctum")->user();

        $lomba = Lomba::create([
            "max_member" => $max_member,
            "min_member" => $min_member,
            "total_juara" => $total_juara,
            "lombaCategory_id" => $lombaCategory_id,
            "roleList" => $request->input('roleList', ''),
            "created_by" => $user !== null ? $user->id_user : 1,
            "start_date" => $start_date,
            "end_date" => $end_date,
            "decide_date" => $decide_date,
        ]);

        $id_lomba = $lomba->id_lomba;

        $lombaHadiah = lombaHadiah::create([
            "lomba_id" => $id_lomba,
            "typeHadiah_id" => 1, //Tipe hadiah uang
            "quantity" => $total_hadiah
        ]);

        $path = public_path() . "/documents/lomba/". $id_lomba;

        if (!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        if ($poster_kompetisi) {
            $poster_kompetisi->move($path, "poster_kompetisi.png");
        }

        if ($guide_book) {
            $guide_book->move($path, "guide_book.pdf");
        }

        if ($preview_foto_kompetisi) {
            $preview_foto_kompetisi->move($path, "preview_foto_kompetisi.png");
        }
        
        $lomba_detail = Lomba_detail::create([
            "lomba_id" => $lomba->id_lomba,
            "title" => $title,
            "description" => $description,
            "penyelenggara_name" => $penyelenggara_name,
            "pic_name" => $pic_name,
            "pic_tel" => $pic_tel,
            "pic_email" => $pic_email
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
    public function show(Lomba $lomba, $id_lomba)
    {
        $getLomba = $lomba::findOrFail($id_lomba);
        $isAdmin = auth("sanctum")->user()->hasRole('Admin');
        if (!$getLomba->isApproved && !$isAdmin) {
            return route("dashboard-explore");
        }
        return view('display.detailLomba.index', ["lomba" => $getLomba]);
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

    public function reject(UpdateLombaRequest $request, Lomba $lomba, $id_lomba)
    {

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

        $path = public_path() . "/documents/lomba/". $id_lomba;
        File::deleteDirectory($path);

        return response()->json([
            "success" => true,
            "status_code" => 200,
            "message" => "Berhasil menghapus data lomba",
        ], 200);
    }
}
