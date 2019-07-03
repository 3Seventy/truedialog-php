<?php
require '../../lib/true_dialog_api.php';
require '../config.php';
use TrueDialogApi\Client;

// Creates a new contact for the given account.
class AddContact {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create Contact factory
        $contactFactory = $client->getFactory("Contact");
        
        // Create Contact object
        $contact = $contactFactory->getNew(array( // Details of the new contact.
            "PhoneNumber" => '', // {string} Mobile number if available.
            "Email" => '', // {string} Email address of the contact.
            "Attributes" => array(), // Nullable{array<array>} or Nullable{array<ContactAttribute>} List of attributes to set for this contact.
            "Subscriptions" => array(), // Nullable{array<array>} or Nullable{array<ContactSubscription>} List of subscriptions this contact should be opted into.
        ));
        
        // Create Contact repository object
        $contactRepo = $client->getRepo("Contact");
        
        // Adding Contact via API
        $result = $contactRepo->add($contact);
        
        // Printing result
        print_r($result);
    }
}
$example = new AddContact();
$example->run();