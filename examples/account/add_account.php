<?php
require '../../lib/true_dialog_api.php';
require '../config.php';
use TrueDialogApi\Client;

// Creates a new account in the system with the specified details.
class AddAccount {
  public function run() {
    // Load the config file
    $config = getConfig();
    
    // Initiate the Client.
    $client = new Client($config);
    
    // Create Account factory
    $accountFactory = $client->getFactory("Account");
    
    // Creating Account object
    $account = $accountFactory->getNew(array( // Details of the new campaign.
        "ParentId" => '', // {int} The identifier of the account that is the parent of this account.
        "Name" => '', // {string} The name of the account
        "Channels" => array(), // {array<int>} Optional list of channels to allow the contact to use.
        //"Attributes" => // {array<AccountAttribute>} List of attributes to set for this account.
    ));
    
    // Create Account repository
    $accountRepo = $client->getRepo("Account");
    
    // Create Account via API
    $result = $accountRepo->add($account);
    
    // Printing result
    print_r( $result );
  }
}
$example = new AddAccount();
$example->run();