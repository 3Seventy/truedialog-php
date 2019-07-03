<?php
require '../../../lib/true_dialog_api.php';
require '../../config.php';
use TrueDialogApi\Client;

// Creates a new template for a content group. Note that you can only have one template per supported language type.
class AddContentTemplate {
    public function run() {
        // Load the config
        $config = getConfig();
        
        // Create Client object
        $client = new Client($config);
        
        // Create ContentTemplate factory
        $contentFactory = $client->getFactory("ContentTemplate");
        
        // Create Content object
        $content = $contentFactory->getNew(array( // Details of the new template's format.
            "LanguageId" => 0, // {int} The language this template is for. (0) English, (1) Spanish, (2) Simplified Chinese
            "ChannelTypeId" => 0, // {int} The type of channel this content can be sent to. (0) SMS, (1) MMS, (2) Email
            "EncodingTypeId" => 0, // {int} The format of the tempalte data. (0) Text, (1) Razor
            "Template" => '', // {string} The actual template
        ));
        
        // The content group which the template will be contained within.
        $content_id = 1;
        
        // Create Content repository object
        $contentRepo = $client->getRepo("Content");
        
        // Adding content via API
        $result = $contentRepo->addTemplate($content_id, $content);
        
        // Printing result
        print_r($result);
    }
}
$example = new AddContentTemplate();
$example->run();