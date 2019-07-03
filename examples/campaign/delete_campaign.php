<?php
require '../../lib/true_dialog_api.php';
require '../config.php';
use TrueDialogApi\Client;

// Removes a campaign from the system.
class DeleteCampaign {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create Campaign repository object
        $campaignRepo = $client->getRepo("Campaign");
        
        // The ID of the campaign to remove.
        $campaign_id = 1;
        
        // Deleting Campaign
        $result = $campaignRepo->delete($campaign_id);
        
        // Printing result
        print_r($result);
    }
}
$example = new DeleteCampaign();
$example->run();