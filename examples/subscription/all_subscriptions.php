<?php
require '../../lib/true_dialog_api.php';
require '../config.php';
use TrueDialogApi\Client;

// Gets a list of all subscriptions for an account.
class AllSubscriptions {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create Subscription repository object
        $subscriptionRepo = $client->getRepo("Subscription");
        
        // Checking this flag will return the results that include child accounts
        $includeChildren = false; // {bool} DEFAULT: false;
        
        // Getting Subscriptions List
        $result = $subscriptionRepo->getAll($includeChildren);
        
        // Printing result
        print_r($result);
    }
}
$example = new AllSubscriptions();
$example->run();