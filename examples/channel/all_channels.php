<?php
require '../../lib/true_dialog_api.php';
require '../config.php';
use TrueDialogApi\Client;

// Returns a list of channels that fall under a given account.
class AllChannels {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create Channel repository object
        $channelRepo = $client->getRepo("Channel");
        
        // Getting Channel List
        $result = $channelRepo->getAll();
        
        // Printing result
        print_r($result);
    }
}
$example = new AllChannels();
$example->run();