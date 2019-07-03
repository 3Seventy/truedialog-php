<?php
require '../../../lib/true_dialog_api.php';
require '../../config.php';
use TrueDialogApi\Client;

// Updates a specific attribute item on a contact.
class EditContactAttribute {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // The contact to which the property belongs.
        $contact_id = 1;
        
        // The name (or attribute defintion ID) of the attribute to update.
        $attribute_name = '';
        
        // The new value for the attribute
        $attribute_value = '';
        
        // Create Contact repository object
        $contactRepo = $client->getRepo("Contact");
        
        // Editing ContactAttribute via API
        $result = $contactRepo->editAttribute($contact_id, $attribute_name, $attribute_value);
        
        // Printing result
        print_r($result);
    }
}
$example = new EditContactAttribute();
$example->run();