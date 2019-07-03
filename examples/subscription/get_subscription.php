<?php
require '../../lib/true_dialog_api.php';
require '../config.php';
use TrueDialogApi\Client;

// Returns the details for a specific subscription object.
class GetSubscription {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create Subscription repository object
        $subscriptionRepo = $client->getRepo("Subscription");
        
        // The ID of the subscription to return.
        $subscription_id = 1;
        
        // Getting Subscription object
        $result = $subscriptionRepo->get($subscription_id);
        
        // Printing result
        print_r($result);
    }
}
$example = new GetSubscription();
$example->run();