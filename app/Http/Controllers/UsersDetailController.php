<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsers_detailRequest;
use App\Http\Requests\UpdateUsers_detailRequest;
use App\Models\bidangMinat;
use App\Models\Mahasiswa_detail;
use App\Models\MahasiswaMinat;
use App\Models\Users_detail;
use Illuminate\Http\Request;

class UsersDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listMinat = bidangMinat::all();
        return view('display.registData.profilling.index', ['listMinat' => $listMinat]);  
    }

    /**
     * Profiling User
     * @OA\Post(
     *     security={{"bearerAuth":{}}},
     *     path="/api/v1/profiling",
     *     tags={"Profiling"},
     *     operationId="profiling-post",
     *     summary="Profiling User",
     *     description="Menambah data profile User",
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "status_code": 200,
     *                 "message": "Berhasil Profiling"
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
    public function profiling(Request $request) {
        $request->validate([
            'gender' => ['required', 'string', 'max:255', 'in:male,female'],
            'birth_date' => ['required', 'date'],
            'telp' => ['required', 'string', 'max:255'],
            'birth_place' => ['required', 'string', 'max:255'],
            'kampus' => ['required', 'string', 'max:255'],
            'jurusan' => ['required', 'string', 'max:255'],
            'bidang' => ['required'],
            'full_name' => ['required', 'string', 'max:255'],
        ]);
        $full_name = $request->full_name;
        $first_name = explode(' ', $full_name)[0];
        $last_name =  explode(' ', $full_name)[1];
        $gender = $request->gender;
        $birth_date = $request->birth_date;
        $telp = $request->telp;
        $birth_place = $request->birth_place;
        $kampus = $request->kampus;
        $jurusan = $request->jurusan;
        $bidang = $request->bidang;
        
        $user = $request->user();

        //Update to users_detail
        $users_detail = $user->user_detail;
        $users_detail->first_name = $first_name;
        $users_detail->last_name = $last_name;
        $users_detail->gender = $gender;
        $users_detail->birth_date = $birth_date;
        $users_detail->tel = $telp;
        $users_detail->birth_place = $birth_place;
        $users_detail->save();

        //Update to mahasiswa_detail
        $mahasiswa_detail = Mahasiswa_detail::create([
            "user_id" => $user->id_user,
            "kampus" => $kampus,
            "jurusan" => $jurusan
        ]);

        //Insert to mahasiswa_minat
        foreach ($bidang as $key => $value) {
            $bidangMinat = bidangMinat::find($value);
            if ($bidangMinat) {
                MahasiswaMinat::create([
                    "user_id" => $user->id_user,
                    "bidang_id" => $value
                ]);
            }
        }

        if ($request->wantsJson()) {
            return response()->json([
                "success" => true,
                "status_code" => 200,
                "message" => "Berhasil Profiling"
            ]);
        } else {
            return redirect()->route('landing');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUsers_detailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Users_detail $users_detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Users_detail $users_detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsers_detailRequest $request, Users_detail $users_detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Users_detail $users_detail)
    {
        //
    }
}
