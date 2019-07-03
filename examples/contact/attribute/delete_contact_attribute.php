<?php
require '../../../lib/true_dialog_api.php';
require '../../config.php';
use TrueDialogApi\Client;

// Removes a specific attribute data item.
class DeleteContactAttribute {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);

        // The contact to which the property belongs.
        $contact_id = 1;
        
        // The name (or attribute defintion ID) of the attribute to remove.
        $attribute_name = '';
        
        // Create Contact repository object
        $contactRepo = $client->getRepo("Contact");
        
        // Deleting ContactAttribute via API
        $result = $contactRepo->deleteAttribute($contact_id, $attribute_name);
        
        // Printing result
        print_r($result);
    }
}
$example = new DeleteContactAttribute();
$example->run();