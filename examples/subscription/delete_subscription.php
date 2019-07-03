<?php
require '../../lib/true_dialog_api.php';
require '../config.php';
use TrueDialogApi\Client;

// Removes a subscription object.
class DeleteSubscription {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create Subscription repository object
        $subscriptionRepo = $client->getRepo("Subscription");
        
        // The ID of the subscription object to remove.
        $subscription_id = 1;
        
        // Deleting Subscription via API
        $result = $subscriptionRepo->delete($subscription_id);
        
        // Printing result
        print_r($result);
    }
}
$example = new DeleteSubscription();
$example->run();