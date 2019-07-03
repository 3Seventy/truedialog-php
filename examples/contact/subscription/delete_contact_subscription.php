<?php
require '../../../lib/true_dialog_api.php';
require '../../config.php';
use TrueDialogApi\Client;

// Opts a contact out of the subscription.
class DeleteContactSubscription {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create Contact repository object
        $contactRepo = $client->getRepo("Contact");
        
        // The ID of the subscription to opt out of.
        $subscripton_id = 1;
        
        // The contact to remove from the subscription.
        $contact_id = 1;
        
        // Opts a contact out of the subscription.
        $result = $contactRepo->deleteSubscription($subscripton_id, $contact_id);
        
        // Printing result
        print_r($result);
    }
}
$example = new DeleteContactAttribute();
$example->run();