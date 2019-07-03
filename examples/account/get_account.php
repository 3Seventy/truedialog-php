<?php
require '../../lib/true_dialog_api.php';
require '../config.php';
use TrueDialogApi\Client;

// Gets detailed information about a specific account.
class GetAccount {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create Account repository object
        $accountRepo = $client->getRepo("Account");
        
        // The ID of the account to retrieve.
        $account_id = 1;
        
        // Getting Account object
        $result = $accountRepo->get($account_id);
        
        // Printing result
        print_r($result);
    }
}
$example = new GetAccount();
$example->run();