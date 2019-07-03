<?php
require '../../lib/true_dialog_api.php';
require '../config.php';
use TrueDialogApi\Client;

// Creates a new campaign with the given details for the supplied account ID.
class AddCampaign {
  public function run() {
    // Load the config file
    $config = getConfig();
    
    // Initiate the Client.
    $client = new Client($config);
    
    // Create Campaign factory
    $campaignFactory = $client->getFactory("Campaign");
    
    // Creating Campaign object
    $campaign = $campaignFactory->getNew(array( // Details of the new campaign.
        "SubscriptionId" => '', // {int} The subscription that contacts who respond to this campaign are opted into.
        "Name" => '', // {string} The campaigns name
        "CampaignTypeId" => '', // {int} The type of campaign: (0) Gateway, (1) Template, (2) Survay, (4) Coupon
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
    
    // Create Campaign repository
    $campaignRepo = $client->getRepo("Campaign");
    
    // Create Campaign via API
    $result = $campaignRepo->add($campaign);
    
    // Printing result
    print_r( $result );
  }
}
$example = new AddCampaign;
$example->run();