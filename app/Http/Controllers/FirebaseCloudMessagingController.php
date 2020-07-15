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
        $token = 'drHczk7X72ZaI2mO1vQs1R:APA91bGyhtZZoDkRQ-7a9UY2az7xy3vjODF_1rWPL3SECKkXzkTJmvkPGwKlBDpaus6Atmnufnbi6qU4-cO24T5t3AuX_7nmpOcEnDVfG4YVRIWTiiIcyLroPBetKLLcHLdGdQbFFOpV';
		$title = 'Henry Title';
        $body = 'Henry Body';
        $icon = secure_asset('images/messaging-icon.png');
        $this->firebaseCloudMessagingService->sendMessageToSingleDevice($token, $title, $body, $icon);
        echo '已發送' . PHP_EOL;
    }
}
