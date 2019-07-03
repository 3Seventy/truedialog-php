<?php
require '../../../lib/true_dialog_api.php';
require '../../config.php';
use TrueDialogApi\Client;

// Example to get ContactSubscription object by Name
class GetContactSubscription {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create Contact repository object
        $contactRepo = $client->getRepo("Contact");
        
        // The subscription ID which the contact has a history with.
        $subscription_id = 1;
        
        // The ID of the contact who's history is to be checked.
        $contact_id = 1;
        
        // Returns opt in information if the contact is opted in.
        $result = $contactRepo->get($subscription_id, $contact_id);
        
        // Printing result
        print_r($result);
    }
}
$example = new GetContactSubscription();
$example->run();