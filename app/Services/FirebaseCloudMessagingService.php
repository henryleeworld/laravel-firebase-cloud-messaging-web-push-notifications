<?php

namespace App\Services;

use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

/**
 * Firebase cloud messaging service
 *
 * @filesource
 */
class FirebaseCloudMessagingService
{
    /**
     * Instantiate a new controller instance.
     *
     * @param OptionsBuilder     $optionsBuilder     Options builder
     * @param PayloadDataBuilder $payloadDataBuilder Payload data builder
     *
     * @return void
     */
    public function __construct(OptionsBuilder $optionsBuilder, PayloadDataBuilder $payloadDataBuilder)
    {
        $this->optionsBuilder     = $optionsBuilder;
        $this->payloadDataBuilder = $payloadDataBuilder;
    }

    /**
     * Send message to single device
     *
     * @param string $token       Token
     * @param string $title       Title
     * @param string $body        Body
     * @param string $icon        Icon
     * @param string $clickAction Click action
     *
     * @return void
     */
    public function sendMessageToSingleDevice($token, $title, $body, $icon = null, $clickAction = null)
    {
        $option = $this->buildOption();
        $payloadNotification = $this->buildPayloadNotification($title, $body, $icon, $clickAction);
        $payloadData = $this->buildPayloadData();
		$this->sendMessage($token, $option, $payloadNotification, $payloadData);
    }

    /**
     * Send message to multiple device
     *
     * @param string $token       Token
     * @param string $title       Title
     * @param string $body        Body
     * @param string $icon        Icon
     * @param string $clickAction Click action
     *
     * @return string
     */
    public function sendMessageToMultipleDevice($title, $body, $icon = null, $clickAction = null)
    {
        $option = $this->buildOption();
        $payloadNotification = $this->buildPayloadNotification($title, $body, $icon, $clickAction);
        $payloadData = $this->buildPayloadData();
        $tokens = MYDATABASE::pluck('fcm_token')->toArray();
		$this->sendMessage($tokens, $option, $payloadNotification, $payloadData);
    }

    /**
     * Build option
     *
     * @return OptionsBuilder
     */
    public function buildOption()
    {
        $this->optionsBuilder->setTimeToLive(60*20);
        return $this->optionsBuilder->build();
    }

    /**
     * Build payload notification
     *
     * @return PayloadNotificationBuilder
     */
    public function buildPayloadNotification($title, $body, $icon = null, $clickAction = null)
    {
        $payloadNotificationBuilder = new PayloadNotificationBuilder($title);
        $payloadNotificationBuilder->setBody($body)
                                   ->setSound('default')
                                   ->setBadge(1)
                                   ->setIcon($icon)
                                   ->setClickAction($clickAction);
        return $payloadNotificationBuilder->build();
    }

    /**
     * Build payload data
     *
     * @return PayloadDataBuilder
     */
    public function buildPayloadData()
    {
        return $this->payloadDataBuilder->build();
    }

    /**
     * Send message
     *
     * @param string                      $tokens              Tokens
     * @param mixed                       $option              Option
     * @param PayloadNotificationBuilder  $payloadNotification Payload notification
     * @param PayloadDataBuilder          $payloadData         Payload data
     *
     * @return void
     */
    public function sendMessage($tokens, $option, $payloadNotification, $payloadData)
    {
        $downstreamResponse = FCM::sendTo($tokens, $option, $payloadNotification, $payloadData);
        $downstreamResponse->numberSuccess();
        $downstreamResponse->numberFailure();
        $downstreamResponse->numberModification();
        $downstreamResponse->tokensToDelete();
        $downstreamResponse->tokensToModify();
        $downstreamResponse->tokensToRetry();
        $downstreamResponse->tokensWithError();
    }
}
