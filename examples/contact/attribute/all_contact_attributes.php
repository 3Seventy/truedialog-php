<?php
require '../../../lib/true_dialog_api.php';
require '../../config.php';
use TrueDialogApi\Client;

// Lists all attributes on a contact as a set of name value pairs.
class AllContactAttributes {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create Contact repository object
        $contactRepo = $client->getRepo("Contact");
        
        // The contact to which the attributes belong.
        $contact_id = 1;
        
        // Getting ContactAttributes List
        $result = $contactRepo->getAllAttributes($contact_id);
        
        // Printing result
        print_r($result);
    }
}
$example = new AllContactAttributes();
$example->run();