<?php
require '../../lib/true_dialog_api.php';
require '../config.php';
use TrueDialogApi\Client;

// Pushes a campaign to a list of phone numbers.
class AddActionPushCampaign {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create ActionPushCampaign factory (optional)
        $pushFactory = $client->getFactory("ActionPushCampaign");
        
        // Create ActionPushCampaign object
        $actionPush = $pushFactory->getNew(array(
            "CampaignId" => '', // {int} REQUIRED: The campaign to push.
            "Channels" => '', // {array<string>} REQUIRED: A list of channel to send the message out on. 
            "ContactListIds" => '', // {array<int>} OPTIONAL: A contact list(s) to push to. 
			"ExcludeListIds" => '', // {array<int>} OPTIONAL: A contact list(s) to push to. 
            "Targets" => '', // {array<string>} OPTIONAL: A list of targets to send to. These can be a mix of phone numbers, emails, or contact IDs.
            "TargetsUrl" => '', // {string} A URL pointing to a list of targets to send to.
            "ForceOptIn" => '', // {boolean} Opt an existing contact into the subscription if opted out
            "From" => '', // {string} Used for email channel. Can specify From address or default will be used.
            "IgnoreSingleUse" => '', // {bool} Check if the event is Single Use Push Event.
            "Message" => '', // {string} Required if campaign type is basic. Forbidden when not basic.
            "Subject" => '', // {string} Subject of the email.
            "Execute" => true, // {bool} Set to send action on creation
        ));
        
        // Create ActionPushCampaign repository object
        $pushRepo = $client->getRepo("ActionPushCampaign");
        
        // Adding ActionPushCampaign via API
        $result = $pushRepo->add($actionPush);
        
        // Printing result
        print_r($result);
    }
}
$example = new AddActionPushCampaign();
$example->run();