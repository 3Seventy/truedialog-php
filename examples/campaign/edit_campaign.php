<?php
require '../../lib/true_dialog_api.php';
require '../config.php';
use TrueDialogApi\Client;

// Update a campaign with new details.
class EditCampaign {
  public function run() {
    // Load the config file
    $config = getConfig();
    
    // Initiate the Client.
    $client = new Client($config);
    
    // Creating Campaign object
    $newCampaign = $client->getFactory("Campaign", array( // Details of the new campaign.
        "SubscriptionId" => '', // {int} The subscription that contacts who respond to this campaign are opted into.
        "Name" => '', // {string} The campaigns name
        "ContentId" => '', // Nullable{int}, Content that this campaign sends.
        "Content" => array( // Nullable{array} or {Content} Content to add to this campaign.
          "Name" => '', // {string} The name of the content
          "Description" => '', // {string} Addtional description data
          "Templates" => array( // {array} or {ContentTemplate} List of templates to create or update along with the content item.
              "LanguageId" => 0, // {int} The language this template is for. (0) English, (1) Spanish, (2) Simplified Chinese
              "ChannelTypeId" => 0, // {int} The type of channel this content can be sent to. (0) SMS, (1) MMS, (2) Email
              "EncodingTypeId" => 1, // {int} The format of the tempalte data (0) Text, (1) Razor
              "Template" => '' // {string} The actual template
          ),
        ),
        "UserData" => '', // {string} Arbitrary user data field
        "SingleUse" => '', // {bool} This Flag is for checking Single Send Campaign. default value is False.
        "SingleUseContentId" => '', // Nullable{int} This is set to the content Id for Single Send Campaign response.
        "Links" => '', // {array<Link>} A list of links to create along with this campaign.
    ));
    
    // The ID of the campaign to update
    $campaign_id = 1;
    
    // Create Campaign repository
    $campaignRepo = $client->getRepo("Campaign");
    
    // Edit Campaign via API
    $result = $campaignRepo->edit($campaign_id, $newCampaign);
    
    // Printing result
    print_r( $result );
  }
}
$example = new EditCampaign;
$example->run();