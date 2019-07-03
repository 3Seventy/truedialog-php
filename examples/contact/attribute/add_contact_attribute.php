<?php
require '../../../lib/true_dialog_api.php';
require '../../config.php';
use TrueDialogApi\Client;

// Creates a specific attribute item on a contact.
class AddContactAttribute {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create CotntactAttribute factory
        $contactAttributeFactory = $client->getFactory("ContactAttribute");
        
        // Create ContactAttribute object
        $contactAttribute = $contactAttributeFactory->getNew(array(
            "Name" => '', // {string} The name (or attribute defintion ID) of the attribute to create.
            "Value" => '' // {string} The value for the attribute
        ));
        
        // Create Contact repository object
        $contactRepo = $client->getRepo("Contact");
        
        // The contact to which the property belongs.
        $contact_id = 1;
        
        // Adding Contact via API
        $result = $contactRepo->addAttribute($contact_id, $contactAttribute);
        
        // Printing result
        print_r($result);
    }
}
$example = new AddContactAttribute();
$example->run();