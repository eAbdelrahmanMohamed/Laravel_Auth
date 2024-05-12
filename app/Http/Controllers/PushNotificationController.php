<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

class PushNotificationController extends Controller
{
    public function sendPushNotification()
    {
        $firebase = (new Factory)
            ->withServiceAccount('C:\xampp\htdocs\LaravelTask\config\fire_base.json');
            $users = User::all();
            $notification = Notification::fromArray([
                'title' => 'New Notification',
                'body' => 'This is a test notification.',
            ]);
        
            foreach ($users as $user) {
                $message = CloudMessage::new()
                    ->withNotification($notification)
                    ->withData(['key' => 'value']); // Optional data
        
                $this->firebase->send($message);
            }
        
            return 'Push notifications sent successfully.';
        
    }
}