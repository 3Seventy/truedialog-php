<?php
require '../../lib/true_dialog_api.php';
require '../config.php';
use TrueDialogApi\Client;

// Does not actually delete the contact, but removes all active subscriptions that contact is participating in.
class DeleteContact {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create Contact repository object
        $contactRepo = $client->getRepo("Contact");
        
        // The ID of the contact to remove
        $contact_id = 1;
        
        // Deleting Contact via API
        $result = $contactRepo->delete($contact_id);
        
        // Printing result
        print_r($result);
    }
}
$example = new DeleteContact();
$example->run();