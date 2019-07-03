<?php
require '../../lib/true_dialog_api.php';
require '../config.php';
use TrueDialogApi\Client;

// Returns the details for a specific callback object.
class GetCallback {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create Callback repository object
        $callbackRepo = $client->getRepo("Callback");
        
        // The ID of the callback to return.
        $callback_id = 1;
        
        // Getting Callack object
        $result = $callbackRepo->get($callback_id);
        
        // Printing result
        print_r($result);
    }
}
$example = new GetCallback();
$example->run();