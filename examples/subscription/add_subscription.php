<?php
require '../../lib/true_dialog_api.php';
require '../config.php';
use TrueDialogApi\Client;

// Creates a new subscription object.
class AddSubscription {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create Subscription factory
        $subscriptionFactory = $client->getFactory("Subscription");
        
        // Create Subscription object
        $subscription = $subscriptionFactory->getNew(array(
            "Name" => '', // {string} Name of the subscription.
            "Label" => '', // {string} Pretty display name of the subscription.
            "SubscriptionTypeId" => '', // {int} The type of subscription, either one-time or recurring. (0) One-time, (1) Reccuring
            "Frequency" => '', // {int} Number of messages sent per month
        ));
        
        // Create Subscription repository object
        $subscriptionRepo = $client->getRepo("Subscription");
        
        // Adding Subscription via API
        $result = $subscriptionRepo->add($subscription);
        
        // Printing result
        print_r($result);
    }
}
$example = new AddSubscription();
$example->run();