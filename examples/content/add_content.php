<?php
require '../../lib/true_dialog_api.php';
require '../config.php';
use TrueDialogApi\Client;

// Creates a new content group.
class AddContent {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create Content factory
        $contentFactory = $client->getFactory("Content");
        
        // Create Content object
        $content = $contentFactory->getNew(array( // The details about the new content group.
            "Name" => "", // {string} The name of the content
            "Description" => "", // {string} Addtional description data
            "Templates" => array() // {array<ContentTemplate>} or {array<array>} List of templates to create or update along with the content item.
        ));
        
        // Create Content repository object
        $contentRepo = $client->getRepo("Content");
        
        // Adding content via API
        $result = $contentRepo->add($content);
        
        // Printing result
        print_r($result);
    }
}
$example = new AddContent();
$example->run();