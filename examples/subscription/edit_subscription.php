<?php
require '../../lib/true_dialog_api.php';
require '../config.php';
use TrueDialogApi\Client;

// Adjusts the details of a subscription object.
class EditSubscription {
  public function run() {
    // Load the config file
    $config = getConfig();
    
    // Initiate the Client.
    $client = new Client($config);
    
    // Creating Subscription object
    $newSubscription = $client->getFactory("Subscription", array( // The new details for the subscription object.
        "Name" => '', // {string} Name of the subscription.
        "Label" => '', // {string} Pretty display name of the subscription.
        "SubscriptionTypeId" => '', // {int} The type of subscription, either one-time or recurring. (0) One-time, (1) Reccuring
        "Frequency" => '', // {int} Number of messages sent per month
    ));
    
    // The ID of the subscription to update.
    $subscription_id = 1;
    
    // Create Subscription repository
    $subscriptionRepo = $client->getRepo("Subscription");
    
    // Edit Subscription via API
    $result = $subscriptionRepo->edit($subscription_id, $newSubscription);
    
    // Printing result
    print_r( $result );
  }
}
$example = new EditSubscription();
$example->run();