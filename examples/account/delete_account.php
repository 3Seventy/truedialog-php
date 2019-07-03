<?php
require '../../lib/true_dialog_api.php';
require '../config.php';
use TrueDialogApi\Client;

// Removes a given account from the system. Note that this does not actually 
// remove the account record, but rather changes its status to inactive.
class DeleteAccount {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create Account repository object
        $accountRepo = $client->getRepo("Account");
        
        // ID of account to disable
        $account_id = 0;
        
        // Deleting Account
        $result = $accountRepo->delete($account_id);
        
        // Printing result
        print_r($result);
    }
}
$example = new DeleteAccount();
$example->run();