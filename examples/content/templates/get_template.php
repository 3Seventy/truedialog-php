<?php
require '../../../lib/true_dialog_api.php';
require '../../config.php';
use TrueDialogApi\Client;

// Gets a single template from within a content group
class GetContentTemplate {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create Content repository object
        $contentRepo = $client->getRepo("Content");
        
        // The content group which the template is contained within.
        $content_id = 1;
        
        // The specific template ID to get
        $template_id = 1;
        
        // Getting Content object
        $result = $contentRepo->getTemplate($content_id, $template_id);
        
        // Printing result
        print_r($result);
    }
}
$example = new GetContentTemplate();
$example->run();