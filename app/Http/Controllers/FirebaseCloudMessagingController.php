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
        $token = 'exzld5iOL9Zl0UICjhBfvu:APA91bF_5CDDjHHVYBguOUW3I8d1KqFys_y7LuJZNKpr7kmtP8qA71OzIWMSNUzwt3piCHRlOaN71LK67syonQ-0x2bg9HyihOW6MFZlyic767b2wY098yUdqLpszQa4Yn1gkjcbumsG';
		$title = 'Henry Title';
        $body = 'Henry Body';
        $icon = secure_asset('images/messaging-icon.png');
        $this->firebaseCloudMessagingService->sendMessageToSingleDevice($token, $title, $body, $icon);
        echo '已發送' . PHP_EOL;
    }
}
