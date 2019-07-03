<?php
require '../../lib/true_dialog_api.php';
require '../config.php';
use TrueDialogApi\Client;

// Gets a specific content group object.
class GetContent {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create Content repository object
        $contentRepo = $client->getRepo("Content");
        
        // The ID of the content group to get.
        $content_id = 1;
        
        // Getting Content object
        $result = $contentRepo->get($content_id);
        
        // Printing result
        print_r($result);
    }
}
$example = new GetContent();
$example->run();