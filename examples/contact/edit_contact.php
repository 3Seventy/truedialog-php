<?php
require '../../lib/true_dialog_api.php';
require '../config.php';
use TrueDialogApi\Client;

// Updates a contact with the newly provided information.
class EditContact {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create Contact repository object
        $contactRepo = $client->getRepo("Contact");
        
        // Creating Contact object
        $newContact = $client->getFactory("Contact", array( // Details of the new contact.
            "PhoneNumber" => '', // {string} Mobile number if available.
            "Email" => '', // {string} Email address of the contact.
            "Attributes" => array(), // Nullable{array<array>} or Nullable{array<ContactAttribute>} List of attributes to set for this contact.
            "Subscriptions" => array(), // Nullable{array<array>} or Nullable{array<ContactSubscription>} List of subscriptions this contact should be opted into.
        ));
        
        // The ID of the contact to update
        $contact_id = 1;
        
        // Editing Contact via API
        $result = $contactRepo->edit($content_id, $newContact);
        
        // Printing result
        print_r($result);
    }
}
$example = new EditContact();
$example->run();