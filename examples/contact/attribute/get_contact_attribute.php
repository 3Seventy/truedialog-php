<?php
require '../../../lib/true_dialog_api.php';
require '../../config.php';
use TrueDialogApi\Client;

// Gets the value for a specific attribute.
class GetContactAttribute {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create Contact repository object
        $contactRepo = $client->getRepo("Contact");
        
        // The contact to which the property belongs.
        $contact_id = 1;
        
        // The name (or attribute defintion ID) of the attribute to get.
        $attribute_name = '';
        
        // Getting ContactAttribute object
        $result = $contactRepo->get($contact_id, $attribute_name);
        
        // Printing result
        print_r($result);
    }
}
$example = new GetContactAttribute();
$example->run();