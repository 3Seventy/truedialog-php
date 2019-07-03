<?php
require '../../lib/true_dialog_api.php';
require '../config.php';
use TrueDialogApi\Client;

// Updates an account with a new set of information.
class EditAccount {
  public function run() {
    // Load the config file
    $config = getConfig();
    
    // Initiate the Client.
    $client = new Client($config);
    
    // Creating Account object
    $newAccount = $client->getFactory("Account", array(
        "Name" => '', // {string} The name of the account
        "ParentId" => '', // {int} The identifier of the account that is the parent of this account.
        //"Attributes" => array(), // {array<AccountAttribute>} List of attributes to change on this account
    ));
    
    // ID of the account to modify.
    $account_id = 1;
    
    // Create Account repository
    $accountRepo = $client->getRepo("Account");
    
    // Edit Account via API
    $result = $accountRepo->edit($account_id, $newAccount);
    
    // Printing result
    print_r( $result );
  }
}
$example = new EditAccount();
$example->run();