<?php
require '../../lib/true_dialog_api.php';
require '../config.php';
use TrueDialogApi\Client;

// Creates a new callback object.
class AddCallback {
  public function run() {
    // Load the config file
    $config = getConfig();
    
    // Initiate the Client.
    $client = new Client($config);
    
    // Create Callback factory
    $callbackFactory = $client->getFactory("Callback");
    
    // Creating Callback object
    $callback = $callbackFactory->getNew(array( // The details for the new callback object.
        "CallbackType" => '', // {int} The type of callback.
        "URL" => '', // {string} URL to callback
        "Active" => '', // {bool} Used to quickly enable/disable the callback.
    ));
    
    // Create Callback repository
    $callbackRepo = $client->getRepo("Callback");
    
    // Create Callback via API
    $result = $callbackRepo->add($callback);
    
    // Printing result
    print_r( $result );
  }
}
$example = new AddCallback();
$example->run();