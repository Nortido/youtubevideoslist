<?php
/**
 * Created by Nortido on 07/04/2017.
 */
namespace App\Http\Controllers;

use Google_Client;
use Google_Service_YouTube;
use Illuminate\Http\Request;

class YoutubeUserVideosListController extends Controller
{
    /**
     * @var Google_Service_YouTube
     */
    protected $youtubeService;

    /**
     * YoutubeUserVideosListController constructor.
     */
    public function __construct()
    {
        $client = new Google_Client();
        $client->setDeveloperKey(config('services.google.key'));

        $this->youtubeService = new Google_Service_YouTube($client);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $request->flash();

        if (!empty($request->input('username')))
        {
            return view('youtube',
                [
                    'data' => $this->getDataFromUser($request)
                ]
            );
        } else {
            return view('youtube');
        }
    }

    /**
     * @param string $username
     *
     * @return array
     */
    private function getVideosListByUsername($username)
    {
        $videosResponse =

        $videos = [];

        foreach ($videosResponse['items'] as $item) {
            $videos[] = $item['snippet'];
        }

        return $videos;
    }

    /**
     * @param Request $request
     * @return \Google_Service_YouTube_PlaylistItemListResponse
     */
    private function getDataFromUser($request)
    {
        return $this->youtubeService->playlistItems->listPlaylistItems('snippet',
            [
                'playlistId' => $this->getUserUploadsPlaylistIdByUsername($request->input('username')),
                'pageToken' => $request->input('pageToken'),
            ]
        );
    }

    /**
     * @param $username
     *
     * @return array
     */
    private function getUserUploadsPlaylistIdByUsername($username)
    {
        $userData = $this->youtubeService->channels->listChannels("contentDetails",
            [
                "forUsername" => $username
            ]
        );
        return $userData['items'][0]['contentDetails']['relatedPlaylists']['uploads'];
    }
}
