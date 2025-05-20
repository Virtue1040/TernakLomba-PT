<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use GetStream\StreamChat\Client as StreamClient;
use App\Services\StreamChatService;
use Illuminate\Support\Facades\Auth;

class CommunicationController extends Controller
{
    protected $streamChatService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(StreamChatService $streamChatService)
    {
        $this->streamChatService = $streamChatService;
    }

    // public function index() {
    //     $userId = Auth::user()->id_user; 
    //     $token = $this->streamChatService->createToken($userId);
    //     // $getUser = User::all();
    //     // $getUsers = [];
    //     // foreach ($getUser as $key => $value) {
    //     //     $getUsers[] = [
    //     //         'id_user' => $value->id_user,
    //     //         'full_name' => $value->user_detail->first_name . ' ' . $value->user_detail->last_name,
    //     //         'email' => $value->email,
    //     //     ];
    //     // }

    //     return view('view.chat', ['userToken' => $token]);
    // }


    // public function createUser(Request $request)
    // {
    //     $request->validate([
    //         'id' => 'required|string',
    //         'name' => 'required|string',
    //     ]);

    //     $user = $this->streamChatService->createUser($request->id, $request->name);
    //     return response()->json($user);
    // }

    public function index() {
        return view('display.dashboard.chat.index');
    }

        
    /**
     * Get Communication Token
     * @OA\Post(
     *     security={{"bearerAuth":{}}},
     *     path="/api/v1/chat/generate-token",
     *     tags={"Communication"},
     *     operationId="com-generate-token",
     *     summary="Generate your communication token",
     *     description="Mengambil Communication Token",
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "status_code": 200,
     *                 "message": "Mengambil Communication Token",
     *                 "data": {
     *                      "token": "A01"
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
    public function generateToken(Request $request)
    {
        $request->validate(['id' => 'required|string']);

        $token = $this->streamChatService->createToken($request->id);
        return response()->json(['token' => $token]);
    }

    /**
     * Reset Channel
     * @OA\Post(
     *     security={{"bearerAuth":{}}},
     *     path="/api/v1/chat/reset-channel",
     *     tags={"Communication"},
     *     operationId="com-resetChannel",
     *     summary="Reset all channel available",
     *     description="Mereset semua channel",
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "status_code": 200,
     *                 "message": "Berhasil mereset channel",
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
    public function resetChannel() {
        $client = $this->streamChatService->client;
        $channels = $client->queryChannels(['type' => ['$exists' => true]]);
        foreach ($channels['channels'] as $channel) {
            $channel = $client->Channel($channel['channel']['type'], $channel['channel']['id']);
            $channel->delete();
        }
        return response()->json([
            'success' => true,
            'status_code' => 200,
            'message' => 'Berhasil mereset channel',
        ]);
    }

    /**
     * Reset Channel
     * @OA\Post(
     *     security={{"bearerAuth":{}}},
     *     path="/api/v1/chat/send-message",
     *     tags={"Communication"},
     *     operationId="com-sendMessage",
     *     summary="Send Message to the channel",
     *     description="Kirim pesan ke channel",
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "status_code": 200,
     *                 "message": "Berhasil mengirim pesan",
     *                 "data" : "test pesan"
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
    public function sendMessage(Request $request)
    {
        $request->validate([
            'channel_type' => 'required|string',
            'id_channel' => 'required|string',
            'message' => 'required|string|max:255',
        ]);

        $channel = $this->streamChatService->client->channel($request->channel_type, $request->id_channel);
        $message = $channel->sendMessage([
            'text' => $request->message,
        ], auth('sanctum')->user()->id_user);

        return response()->json([
            'success' => true,
            'status_code' => 200,
            'message' => 'Berhasil mengirim pesan',
            'data' => $message,
        ]);
    }

    // public function getImage(Request $request) {
    //     $user = User::find($request->id);
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Berhasil mengambil data Image',
    //         'data' => $user->user_detail->profilePath ? $user->user_detail->profilePath : $user->social_avatar,
    //     ]);
    // }

    /**
     * Get All Channel Affiliated
     * @OA\Get(
     *     security={{"bearerAuth":{}}},
     *     path="/api/v1/chat/get-channels",
     *     tags={"Communication"},
     *     operationId="com-getChannel",
     *     summary="Get All Channel Affiliated",
     *     description="Mengambil semua channel yang ada di User",
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "status_code": 200,
     *                 "message": "Mengambil semua channel yang ada di User",
     *                 "data" : {
     * 
     *                 }
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
    public function getUserChannel(Request $request)
    {
        $channels = $this->streamChatService->getUserChannels(strval(Auth::user()->id_user));
        return response()->json([
            'success' => true,
            'status_code' => 200,
            'message' => 'Mengambil semua channel yang ada di User',
            'data' => $channels
        ]);
    }
}
