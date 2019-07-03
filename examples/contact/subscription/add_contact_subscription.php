<?php
require '../../../lib/true_dialog_api.php';
require '../../config.php';
use TrueDialogApi\Client;

// Opts a contact into the subscription. Contacts are sent a handset verificaton message.
class AddContactSubscription {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create ContactSubscription factory
        $contactSubscriptionFactory = $client->getFactory("ContactSubscription");
        
        // Create ContactSubscription object
        $contactSubscription = $contactSubscriptionFactory->getNew(array(
            "ContactId" => '', // {int} REQUIRED: The ID of the contact that is opted in.
            "SmsEnabled" => '', // {bool} OPTIONAL: Set if we can send an SMS to this contact on this subscription.
            "MmsEnabled" => '', // {bool} OPTIONAL: Set if we can send a MMS to this contact on this subscription.
            "EmailEnabled" => '', // {bool} OPTIONAL: Set if we can send an email to this contact on this subscription.
            "VoiceEnabled" => '' // {bool} OPTIONAL: Set if we can send a voice message to this contact on this subscription.
        ));
        
        // Create Contact repository object
        $contactRepo = $client->getRepo("Contact");
        
        // The subscription ID which the contact is to be opted into.
        $subscription_id = 1;
        
        // Adding ContactSubscription via API
        $result = $contactRepo->addSubscription($subscription_id, $contactSubscription);
        
        // Printing result
        print_r($result);
    }
}
$example = new AddContactSubscription();
$example->run();