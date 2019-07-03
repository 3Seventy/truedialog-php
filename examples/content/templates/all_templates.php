<?php
require '../../../lib/true_dialog_api.php';
require '../../config.php';
use TrueDialogApi\Client;

// Returns all templates on a content group.
class AllContentTemplates {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create Content repository object
        $contentRepo = $client->getRepo("Content");
        
        // The content group which the templates are contained within.
        $content_id = 1;
        
        // Getting Content List
        $result = $contentRepo->getAllTemplates($content_id);
        
        // Printing result
        print_r($result);
    }
}
$example = new AllContentTemplates();
$example->run();