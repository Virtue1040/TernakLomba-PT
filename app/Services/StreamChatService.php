<?php

namespace App\Services;

use GetStream\StreamChat\Client as StreamClient;
use Illuminate\Support\Facades\Auth;

class StreamChatService
{
    public $client;

    public function __construct()
    {
        $this->client = new StreamClient(env('STREAM_API_KEY'), env('STREAM_API_SECRET'));
    }

    public function createUser($userId, $name, $imagePath)
    {
        return $this->client->upsertUser([
            'id' => $userId,
            'name' => $name,
            'role' => 'user',
            'image' => $imagePath,
        ]);
    }

    public function createToken($userId)
    {
        return $this->client->createToken($userId);
    }

    public function getUserChannels($userId)
    {

        $channels = $this->client->queryChannels([
            'members' => ['$in' => [$userId]],
        ]);

        return $channels;
    }

    public function getChannelsById($id)
    {
        $channels = $this->client->queryChannels([
            'id' => $id,
        ]);

        return $channels;
    }

    public function createChannel($channeltype = 'messaging', $members, $name = 'General', $id)
    {
        $channelId = $id;
        $exists = $this->client->queryChannels([
            'id' => $channelId,
        ]); 
        if (count($exists['channels']) > 0) {
            $channel = $this->client->channel($channeltype, $channelId);
            if ($channeltype === 'messaging') {
                $channel->addMembers([strval(Auth::user()->id_user)]);
            } else {
                $channel->addMembers([$members[0]]);
            }
        } else {
            $data = [
                'name' => $name,
                'members' => $members,
            ];
            $channel = $this->client->channel($channeltype, $channelId, $data);
            $channel->create($members[0]);
        }

        return $channel;
    }
}
