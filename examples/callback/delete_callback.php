<?php
require '../../lib/true_dialog_api.php';
require '../config.php';
use TrueDialogApi\Client;

// Removes a callback object. Note that it is possible to prevent a callback 
// from being triggered temporarily without deleting it by setting that callbacks "active" flag to false.
class DeleteCallback {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create Callback repository object
        $callbackRepo = $client->getRepo("Callback");
        
        // The ID of the callback object to remove.
        $callback_id = 0;
        
        // Deleting Callback
        $result = $callbackRepo->delete($callback_id);
        
        // Printing result
        print_r($result);
    }
}
$example = new DeleteCallback();
$example->run();