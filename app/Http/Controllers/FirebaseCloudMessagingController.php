<?php

namespace App\Http\Controllers;

use App\Services\FirebaseCloudMessagingService;

class FirebaseCloudMessagingController extends Controller
{
    /**
     * @var firebaseCloudMessagingService
     */
    protected $firebaseCloudMessagingService;

    /**
     * Instantiate a new controller instance.
     *
     * @param FirebaseCloudMessagingService $firebaseCloudMessagingService Firebase cloud messaging service
     *
     * @return void
     */
    public function __construct(FirebaseCloudMessagingService $firebaseCloudMessagingService)
    {
        $this->firebaseCloudMessagingService = $firebaseCloudMessagingService;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        return view('messaging');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function sendMessage()
    {
        $token = 'fYxzUlpFgNt5iyrwqcAzA4:APA91bE5_2ut6jttFKkC7InvB062RKwSA5xjc_wo82a_jF8ahvfMpL6ftlDJB8dnQD3wUj7hPemwOmQkbH4cR_a-v_1lBcLeCOU5UktIIifTBA0XyASiVnn4lIRD7fLFmBC7BnJ_2fyp';
		$title = '亨利的世界標題';
        $body = '亨利的世界內容';
        $icon = secure_asset('images/messaging-icon.png');
        $this->firebaseCloudMessagingService->sendMessageToSingleDevice($token, $title, $body, $icon);
        echo '已發送' . PHP_EOL;
    }
}
