<?php
require '../../lib/true_dialog_api.php';
require '../config.php';
use TrueDialogApi\Client;

// Returns a list of accounts that exist for the user currently logged in.
class AllAccounts {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create Account repository object
        $accountRepo = $client->getRepo("Account");
        
        // OPTIONAL: Set to true to get all accounts, active and inactive.
        $inactive = false; // {bool} DEFAULT: false
        
        // Getting Accounts List
        $result = $accountRepo->getAll($inactive);
        
        // Printing result
        print_r($result);
    }
}
$example = new AllAccounts();
$example->run();