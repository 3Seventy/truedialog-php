<?php
namespace TrueDialogApi\Model;

/* ActionPushCampaign factory and model entity.
 * extends BaseAudited.
 */
class ActionPushCampaign extends BaseAudited {
    
    /* {int} The account ID the event belongs to. */
    public $account_id;
    
    /* {array<string>} A list of channel to send the message out on. */
    public $channels;
    
    /* {array<string>} A list of targets to send to. These can be a mix of phone numbers, emails, or contact IDs. */
    public $targets;
    
    /* {string} A URL pointing to a list of targets to send to. */
    public $targets_url;
    
	/* {array<string>} A contact list(s) to push to. */
    public $contact_list_ids;
    
	/* {array<string>} A contact list(s) to exclude from targets. */
    public $exclude_list_ids;
	
    /* {int} The campaign to push. */
    public $campaign_id;
    
    /* {string} Used for email channel. Can specify From address or default will be used. */
    public $from;
    
    /* {bool} Check to ignore Single Use campaign property. */
    public $ignore_single_use;
    
    /* {bool} Opt an existing contact into the subscription if opted out. */
    public $force_opt_in;
    
    /* {string} Required if campaign type is basic. Forbidden when not basic. */
    public $message;
    
    /* {string} Subject of the email. */
    public $subject;
    
	/* {bool} Set to execute action on creation */
	public $execute;
    
    /* Constructs ActionPushCampaign entity
     * @param $data {ActionPushCampaign} || {array} || {JSON} New ActionPushCampaign entity details.
     * @return {ActionPushCampaign} new ActionPushCampaign entity.
     */
    public function __construct($data = null) {
        if(is_string($data)){
          $data = json_decode($data);
        }
        $data = (array) $data;
        
        parent::__construct($data);
        
        $this->account_id = isset($data['AccountId']) ? $data['AccountId'] : null;
        $this->channels = isset($data['Channels']) ? $data['Channels'] : null;
        $this->targets = isset($data['Targets']) ? $data['Targets'] : null;
        $this->targets_url = isset($data['TargetsUrl']) ? $data['TargetsUrl'] : null;
        $this->contact_list_ids = isset($data['ContactListIds']) ? $data['ContactListIds'] : null;
		$this->exclude_list_ids = isset($data['ExcludeListIds']) ? $data['ExcludeListIds'] : null;
        $this->campaign_id = isset($data['CampaignId']) ? $data['CampaignId'] : null;
        $this->from = isset($data['From']) ? $data['From'] : null;
        $this->ignore_single_use = isset($data['IgnoreSingleUse']) ? $data['IgnoreSingleUse'] : null;
        $this->force_opt_in = isset($data['ForceOptIn']) ? $data['ForceOptIn'] : null;
        $this->message = isset($data['Message']) ? $data['Message'] : null;
        $this->subject = isset($data['Subject']) ? $data['Subject'] : null;
        $this->execute = isset($data['Execute']) ? $data['Execute'] : true;
    }
    
    /* ActionPushCampaign factory method to create new ActionPushCampaign entity.
     * @param $data {ActionPushCampaign} || {array} || {JSON} New ActionPushCampaign entity details.
     * @return {ActionPushCampaign} new ActionPushCampaign entity.
     */
    public function getNew($data){
        foreach($this as $key => $value){
            unset($this->$key);
        }
        self::__construct($data);
        return $this;
    }
    
    /* Creates array from current object.
     * Used to send submissions to API.
     * @return {array} Array representation of current object.
     */
    public function toArray(){
        return array(
            "Channels" => $this->channels,
            "Targets" => $this->targets,
            "TargetsUrl" => $this->targets_url,
            "ContactListIds" => $this->contact_list_ids,
			"ExcludeListIds" => $this->exclude_list_ids,
            "CampaignId" => $this->campaign_id,
            "From" => $this->from,
            "IgnoreSingleUse" => $this->ignore_single_use,
            "ForceOptIn" => $this->force_opt_in,
            "Message" => $this->message,
            "Subject" => $this->subject,
			"Execute" => $this->execute
        );
    }
    
    /* Creates the JSON string from current ActionPushCampaign object.
     * @return {string} JSON string.
     */
    public function _json(){
        $hash = array(
            "Id" => $this->id,
            "AccountId" => $this->account_id,
            "Channels" => $this->channels,
            "Targets" => $this->targets,
            "TargetsUrl" => $this->targets_url,
            "ContactListIds" => $this->contact_list_ids,
			"ExcludeListIds" => $this->exclude_list_ids,
            "CampaignId" => $this->campaign_id,
            "From" => $this->from,
            "IgnoreSingleUse" => $this->ignore_single_use,
            "ForceOptIn" => $this->force_opt_in,
            "Message" => $this->message,
            "Subject" => $this->subject,
			"Execute" => $this->execute
        );
        return json_encode($hash);
    }
}