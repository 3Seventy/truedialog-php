<?php
require '../../../lib/true_dialog_api.php';
require '../../config.php';
use TrueDialogApi\Client;

// Gets a list of contacts that have opted into the subscription
class AllContactSubscriptons {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create Contact repository object
        $contactRepo = $client->getRepo("Contact");
        
        // The subscription to get the contact list from.
        $subscription_id = 1;
        
        // Getting ContactSubscription List
        $result = $contactRepo->getAllSubscriptions($subscription_id);
        
        // Printing result
        print_r($result);
    }
}
$example = new AllContactSubscriptons();
$example->run();