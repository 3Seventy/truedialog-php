<?php
require '../../../lib/true_dialog_api.php';
require '../../config.php';
use TrueDialogApi\Client;

// Removes a template from a content group.
class DeleteContentTemplate {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create Content repository object
        $contentRepo = $client->getRepo("Content");
        
        // The content group which the template is contained within.
        $content_id = 1;
        
        // The specific template ID to remove
        $template_id = 1;
        
        // Deleting Content via API
        $result = $contentRepo->deleteTemplate($content_id, $template_id);
        
        // Printing result
        print_r($result);
    }
}
$example = new DeleteContentTemplate();
$example->run();