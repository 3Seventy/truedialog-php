<?php
require '../../lib/true_dialog_api.php';
require '../config.php';
use TrueDialogApi\Client;

// Gets details of a specific channel.
class GetChannel {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create Channel repository object
        $channelRepo = $client->getRepo("Channel");
        
        // The ID of the channel to get the details of.
        $channel_id = 1;
        
        // Getting Channel object
        $result = $channelRepo->get($channel_id);
        
        // Printing result
        print_r($result);
    }
}
$example = new GetChannel();
$example->run();