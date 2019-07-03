<?php
require '../../../lib/true_dialog_api.php';
require '../../config.php';
use TrueDialogApi\Client;

// Updates a contact's subscription recept options. Note that if no options are set, then the subscription is removed. Contacts are sent a handset verificaton message.
class EditContactSubscription {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create Contact Subscription factory
        $contactSubscriptionFactory = $client->getFactory("ContactSubscription");
        
        // Create Contact Subscription object
        $newContactSubscription = $contactSubscriptionFactory->getNew(array(
            "SmsEnabled" => '', // {bool} Set if we can send an SMS to this contact on this subscription.
            "MmsEnabled" => '', // {bool} Set if we can send a MMS to this contact on this subscription.
            "EmailEnabled" => '', // {bool} Set if we can send an email to this contact on this subscription.
            "VoiceEnabled" => '' // {bool} Set if we can send a voice message to this contact on this subscription.
        ));
        
        // Create Contact repository object
        $contactRepo = $client->getRepo("Contact");
        
        // The ID of the subscription the contact is in.
        $subscription_id = 1;
        
        // The contact who's subscription preferences are to be changed.
        $contact_id = 1;
        
        // Updates a contact's subscription recept options.
        $result = $contactRepo->editSubscription($subscription_id, $contact_id, $newContactSubscription);
        
        // Printing result
        print_r($result);
    }
}
$example = new EditContactSubscription();
$example->run();