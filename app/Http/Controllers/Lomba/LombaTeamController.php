<?php

namespace App\Http\Controllers\Lomba;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lomba\StorelombaTeamRequest;
use App\Http\Requests\Lomba\UpdatelombaTeamRequest;
use App\Models\Lomba;
use App\Models\lombaMember;
use App\Models\lombaTeam;
use App\Models\User;
use App\Services\StreamChatService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LombaTeamController extends Controller
{
    protected StreamChatService $streamChatService;

    function __construct(StreamChatService $streamChatService)
    {
        $this->middleware('permission:team-read', ['only' => ['index', 'show']]);
        $this->middleware('permission:team-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:team-join', ['only' => ['join']]);
        $this->middleware('permission:team-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:team-delete', ['only' => ['destroy']]);

        $this->streamChatService = $streamChatService;
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
     *                          "team_name": "Team Kocak Abis",
     *                          "isPrivate": false,
     *                          "isApproved": false,
     *                          "updated_at": "2025-05-12T03:00:22.000000Z",
     *                          "created_at": "2025-05-12T03:00:22.000000Z",
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
     * Join Lomba Team
     * @OA\Post(
     *     security={{"bearerAuth":{}}},
     *     path="/api/v1/lombaTeam/{team_code}",
     *     tags={"Lomba Team"},
     *     operationId="lombaTeam-join",
     *     summary="Join Lomba Team",
     *     description="Bergabung dengan tim lomba yang sudah ada",
     *     @OA\Parameter(
     *         name="team_code",
     *         in="path",
     *         description="Team Code",
     *         example = "1939",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="role",
     *         in="query",
     *         description="Role",
     *         example = "UI/UIX Designer",
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
     *                 "message": "Berhasil bergabung ke team lomba",
     *                 "data": {
     *                      {
     *                          "team_id": 1,
     *                          "user_id": 1,
     *                          "role": "",
     *                          "isLeader": false,
     *                          "updated_at": "2025-05-12T03:00:22.000000Z",
     *                          "created_at": "2025-05-12T03:00:22.000000Z",
     *                      }
     *                 },
     *             }
     *         ),
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Error: Team tidak ditemukan",
     *         @OA\JsonContent(
     *             example={{
     *                 "success": false,
     *                 "status_code": 400,
     *                 "message": "Team tidak ditemukan"
     *             },{
     *                 "success": false,
     *                 "status_code": 400,
     *                 "message": "User sudah join didalam tim"
     *             }}
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
    public function join(Request $request, $team_code)
    {
        $request->validate([
            "role" => ["required", "string", "max:100"]
        ]);

        $role = $request->input("role", "");
        $team = lombaTeam::where("team_code", $team_code)->first();

        if ($team === null) {
            return response()->json([
                "success" => false,
                "status_code" => 400,
                "message" => "Team tidak ditemukan",
            ], 400);
        }
        
        $userId = auth("sanctum")->user()->id_user;
        $isJoined = lombaMember::where("team_id", $team->id_team)->where("user_id", $userId)->first();

        if ($isJoined) {
            return response()->json([
                "success" => false,
                "status_code" => 400,
                "message" => "User sudah join didalam tim",
            ], 400);
        }

        $channel = $this->streamChatService->client->Channel(
            "team",
            "Compspace-" . $team->lomba_id . "-" . $team->id_team,
            [
                "compspace_name" => $team->team_name
            ]);
        $channel->addMembers([strval($userId)]);

        $member = lombaMember::create([
            'team_id' => $team->id_team,
            'user_id' => $userId,
            'role' => $role,
            'isLeader' => 0
        ]);

        return response()->json([
            "success" => true,
            "status_code" => 200,
            "message" => "Berhasil bergabung ke team lomba",
            "data" => $member
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
     *                          "team_name": "Team Kocak Abis",
     *                          "isPrivate": false,
     *                          "isApproved": false,
     *                          "updated_at": "2025-05-12T03:00:22.000000Z",
     *                          "created_at": "2025-05-12T03:00:22.000000Z",
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
     *         name="team_name",
     *         in="query",
     *         description="Nama Team",
     *         example = "Team Kocak Abis",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="max_member",
     *         in="query",
     *         description="Maks member",
     *         example = "3",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="isPrivate",
     *         in="query",
     *         description="Apakah private?",
     *         example = "false",
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
     *                          "team_name": "Team Kocak Abis",
     *                          "isPrivate": false,
     *                          "isApproved": false,
     *                          "updated_at": "2025-05-12T03:00:22.000000Z",
     *                          "created_at": "2025-05-12T03:00:22.000000Z",
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
            'lomba_id' => ["required", "integer", "exists:".Lomba::class.",id_lomba"],
            'team_name' => ["required", "string", "max:255"],
            'max_member' => ["required", "integer", "min:1"],
            'isPrivate' => ["required", "boolean"]
        ]);
        $lomba_id = $request->lomba_id;
        $getLomba = lomba::findOrFail($lomba_id);
        $team_name = $request->team_name;
        $isPrivate = filter_var($request->input('isPrivate'), FILTER_VALIDATE_BOOLEAN);
        $max_member = $request->max_member <= $getLomba->max_member ? $request->max_member : $getLomba->max_member;
        $max_member = $max_member > $getLomba->min_member ? $getLomba->min_member : $max_member;
        $userId = auth("sanctum")->user()->id_user;

        $team = lombaTeam::create([
            'lomba_id' => $lomba_id,
            'team_code' => rand(1000, 9999),
            'team_name' => $team_name,
            'created_by' => auth("sanctum")->user()->id_user,
            'max_member' => $max_member,
            'isPrivate' => $isPrivate,
            'isApproved' => true
        ]);

        $channel = $this->streamChatService->client->Channel(
            "team",
            "Compspace-" . $lomba_id . "-" . $team->id_team,
            [
                "compspace_name" => $team_name
            ]);
            $channel->create(strval($userId));
            $channel->addMembers([strval($userId)]);

        $member = lombaMember::create([
            'team_id' => $team->id_team,
            'user_id' => $userId,
            'role' => '',
            'isLeader' => 1
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
     *                          "team_name": "Team Kocak Abis",
     *                          "isPrivate": false,
     *                          "isApproved": false,
     *                          "updated_at": "2025-05-12T03:00:22.000000Z",
     *                          "created_at": "2025-05-12T03:00:22.000000Z",
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
