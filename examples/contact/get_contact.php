<?php
require '../../lib/true_dialog_api.php';
require '../config.php';
use TrueDialogApi\Client;

// Gets the details for a specific contact.
class GetContact {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create Contact repository object
        $contactRepo = $client->getRepo("Contact");
        
        // The ID of the contact.
        $contact_id = 1;
        
        // Getting Contact object
        $result = $contactRepo->get($contact_id);
        
        // Printing result
        print_r($result);
    }
}
$example = new GetContact();
$example->run();