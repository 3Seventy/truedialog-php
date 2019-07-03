<?php
require '../../../lib/true_dialog_api.php';
require '../../config.php';
use TrueDialogApi\Client;

// Updates a template to a new format.
class EditContentTemplate {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create Content repository object
        $contentRepo = $client->getRepo("Content");
        
        // The content group which the template is contained within.
        $content_id = 1;
        
        // The specific template ID to update
        $template_id = 1;
        
        // Create Content factory
        $templateFactory = $client->getFactory("ContentTemplate");
        
        // Create edited Content object
        $newTemplate = $templateFactory->getNew(array(
            "LanguageId" => 0, // {int} The language this template is for. (0) English, (1) Spanish, (2) Simplified Chinese
            "ChannelTypeId" => 0, // {int} The type of channel this content can be sent to. (0) SMS, (1) MMS, (2) Email
            "EncodingTypeId" => 0, // {int} The format of the tempalte data. (0) Text, (1) Razor
            "Template" => '', // {string} The actual template
        ));
        
        // Editing ContentTemplate via API
        $result = $contentRepo->editTemplate($content_id, $template_id, $newTemplate);
        
        // Printing result
        print_r($result);
    }
}
$example = new EditContentTemplate();
$example->run();