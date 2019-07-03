<?php
require '../../lib/true_dialog_api.php';
require '../config.php';
use TrueDialogApi\Client;

// Adjusts the details of a callback object.
class EditCallback {
  public function run() {
    // Load the config file
    $config = getConfig();
    
    // Initiate the Client.
    $client = new Client($config);
    
    // Creating Callback object
    $newCallback = $client->getFactory("Callback", array( // The new details for the callback object.
        "CallbackType" => '', // {int} The type of callback.
        "URL" => '', // {string} URL to callback
        "Active" => '', // {bool} Used to quickly enable/disable the callback.
    ));
    
    // The ID of the callback to update.
    $callback_id = 1;
    
    // Create Callback repository
    $callbackRepo = $client->getRepo("Callback");
    
    // Edit Callback via API
    $result = $callbackRepo->edit($callback_id, $newCallback);
    
    // Printing result
    print_r( $result );
  }
}
$example = new EditCallback();
$example->run();