<?php
require '../../lib/true_dialog_api.php';
require '../config.php';
use TrueDialogApi\Client;

// Lists all content group objects on an account.
class AllContent {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create Content repository object
        $contentRepo = $client->getRepo("Content");
        
        // Getting Content List
        $result = $contentRepo->getAll();
        
        foreach ($result as $content){ // OPTIONAL: get ContentTemplates
            // Loading templates
            $contentRepo->loadTemplates($content); // Returns templates and set templates to Content object
                // Equal to: 
                // $templates = $contentRepo->getAllTemplates($content->getId()); 
                // $content->setTemplates($templates);
        }
        
        // Printing result
        print_r($result);
    }
}
$example = new AllContent();
$example->run();