<?php

namespace App\Services;

use App\Models\Notification;
use Elasticsearch\ClientBuilder;
use phpDocumentor\Reflection\Types\This;

class NotificationService extends Service
{
    private $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()->build();
    }

    protected function model()
    {
        return Notification::class;
    }

    public static function sendSms($mobile, $message)
    {
        /*ini_set("soap.wsdl_cache_enabled", "0");
        $sms_client = new \SoapClient(config('notification.sms_service_url'), array('encoding' => 'UTF-8'));
        $parameters['username'] = config('notification.sms_username');
        $parameters['password'] = config('notification.sms_password');
        $parameters['to'] = $mobile;
        $parameters['from'] = config('notification.sms_number');
        $parameters['text'] = $message;
        $parameters['isflash'] = false;

        return $sms_client->SendSimpleSMS2($parameters)->SendSimpleSMS2Result;*/
    }

    public static function sendEmail($email, $data)
    {

    }

    public function notify($userId, $data)
    {
        $notification = [
            'body' => [
                'user_id' => $userId,
                'platform' => $data['platform'],
                'in_queue' => $data['in_queue'] ?? false,
                'send_at' => $data['send_at'],
            ],
            'index' => 'notification',
            'type' => 'notification'
        ];

        $this->client->index($notification);
    }

    public function getUserNotifications($userId, $request)
    {
        $params = [
            'index' => 'notification',
            'type' => 'notification',
            'body' => [
                'query' => [
                    'bool' => [
                        'must' => [
                            'match' => ['user_id' => $userId]
                        ]
                    ]
                ]
            ]
        ];

        return $this->client->search($params);
    }
}
