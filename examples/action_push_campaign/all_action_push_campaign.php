<?php
require '../../lib/true_dialog_api.php';
require '../config.php';
use TrueDialogApi\Client;

// Gets the details of all push campaign event of an account.
class AllActionPushCampaign {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create ActionPushCampaign repository object
        $pushRepo = $client->getRepo("ActionPushCampaign");
        
        // Getting ActionPushCampaign List
        $result = $pushRepo->getAll();
        
        // Printing result
        print_r($result);
    }
}
$example = new AllActionPushCampaign();
$example->run();