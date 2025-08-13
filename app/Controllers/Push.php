<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;

class PushNotificationController extends Controller
{
    use ResponseTrait;

    protected $pushManager;

    public function __construct()
    {
        // Assume you have a library for handling push notifications, e.g., web-push-php
        $this->pushManager = new \Minishlink\WebPush\WebPush([
            'VAPID' => [
                'subject' => 'mailto:you@example.com',
                'publicKey' => getenv('VAPID_PUBLIC_KEY'),
                'privateKey' => getenv('VAPID_PRIVATE_KEY'),
            ],
        ]);
    }

    public function subscribe()
    {
        $input = $this->request->getJSON(true);
        $endpoint = $input['endpoint'] ?? null;
        $keys = $input['keys'] ?? null;

        if (!$endpoint || !$keys) {
            return $this->fail('Invalid subscription data', 400);
        }

        // Save the subscription data to your database
        // This is crucial! You'll need this to send notifications later.
        $subscription = [
            'endpoint' => $endpoint,
            'expirationTime' => null, // or from the client if available
            'p256dh' => $keys['p256dh'] ?? null,
            'auth' => $keys['auth'] ?? null,
        ];

        // Store this subscription in your database table (e.g., `subscriptions`)
        // Example:
        // $model = new \App\Models\SubscriptionModel();
        // $model->save($subscription);

        return $this->respondCreated(['message' => 'Subscription successful']);
    }

    public function sendNotification()
    {
        // This is an example function to trigger a notification
        // In a real-world scenario, this might be triggered by an event, a cron job, etc.

        // Get all subscriptions from your database
        // Example:
        // $model = new \App\Models\SubscriptionModel();
        // $subscriptions = $model->findAll();

        // Sample notification data
        $payload = json_encode([
            'title' => 'Hello from CodeIgniter!',
            'body' => 'This is a push notification.',
            'icon' => '/path/to/your/icon.png',
            'badge' => '/path/to/your/badge.png',
            'data' => [
                'url' => 'https://example.com/some-page',
            ],
        ]);

        // Loop through each subscription and send the notification
        foreach ($subscriptions as $subscriptionData) {
            $subscription = \Minishlink\WebPush\Subscription::create([
                'endpoint' => $subscriptionData['endpoint'],
                'publicKey' => $subscriptionData['p256dh'],
                'authToken' => $subscriptionData['auth'],
                'contentEncoding' => 'aesgcm',
            ]);

            try {
                $this->pushManager->sendOneNotification($subscription, $payload);
            } catch (\Exception $e) {
                // Handle errors, e.g., subscription expired or invalid
                // You might want to delete the subscription from your database here
                log_message('error', 'Failed to send push notification: ' . $e->getMessage());
            }
        }

        // Flush all notifications
        $this->pushManager->flush();

        return $this->respond(['message' => 'Notifications sent']);
    }
}