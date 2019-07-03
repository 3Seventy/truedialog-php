<?php
require '../../lib/true_dialog_api.php';
require '../config.php';
use TrueDialogApi\Client;

// Updates details about a content group.
class EditContent {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create Content repository object
        $contentRepo = $client->getRepo("Content");
        
        // The ID of the content group.
        $content_id = 1;
        
        // Create Content factory
        $contentFactory = $client->getFactory("Content");
        
        // Create edited Content object
        $newContent = $contentFactory->getNew(array(
            "Name" => "", // {string} The name of the content
            "Description" => "", // {string} Addtional description data
            "Templates" => array() // {array<ContentTemplate>} or {array<array>} List of templates to create or update along with the content item.
        ));
        
        // Editing Content via API
        $result = $contentRepo->edit($content_id, $newContent);
        
        // Printing result
        print_r($result);
    }
}
$example = new EditContent();
$example->run();