<?php
require '../../lib/true_dialog_api.php';
require '../config.php';
use TrueDialogApi\Client;

// Gets the details for a specific push campaign event.
class GetActionPushCampaign {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create ActionPushCampaign repository object
        $pushRepo = $client->getRepo("ActionPushCampaign");
        
        // The specific event to get
        $action_id = 1;
        
        // Getting ActionPushCampaign object
        $result = $pushRepo->get($action_id);
        
        // Printing result
        print_r($result);
    }
}
$example = new GetActionPushCampaign();
$example->run();