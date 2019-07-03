<?php
namespace TrueDialogApi\Model;

/* Campaign factory and model entity.
 * extends SoftDeletable.
 */
class Campaign extends SoftDeletable{
  
    /* {int} The account ID to which the campaign belongs. */
    public $account_id;

    /* {int} The ID of the subscription that contacts will be opted into. */
    public $subscription_id;

    /* {string} The campaign's name and this is a free form name. */
    public $name;

    /* {int} The campaign's type. */
    public $campaign_type_id;

    /* {int} The Id of the Content that this campaign sends. */
    public $content_id;
    
    /* {Content} Content object */
    public $content;

    /* {string} If this campaign will start a new session. If set then when the contact texts into an attached keyword or the campaign is pushed to a contact they are placed into a session. This is used by dialog campaigns to manage responses without colliding with reserved keywords. Currently this value cannot be customized. */
    public $session;

    /* {string} The duration of sessions in milliseconds from start. Currently this value cannot be customized. */
    public $session_length;

    /* {string} The arbitrary user data field. This an area to store free form data. The Vector Portal uses this field to store some UI hints. */
    public $user_data;

    /* {string} if the campaign is a one time use campagin. This an area to store free form data. Single use campaigns can only be sent to a contact once. If the campaign is pushed to a contact more than once then nothing is sent to that contact. If the contact texts into a keyword that is attached to a single use campaign then they are sent the contents of the single_use_content_id value. */
    public $single_use;

    /* {int} The ID of the Content to send if a contact texts into a single use campaign more than once. This field is only valid for campaigns marked as single_use. This content is only sent if a contact texts into a keyword attached to the single use campaign. If the campaign is pushed to the contact then nothing is sent to them. */
    public $single_use_content_id;

    /* Campaign factory method to create new Campaign entity.
     * @param $data {Campaign} || {array} || {JSON} New Campaign entity details.
     * @return {Campaign} New Campaign entity.
     */
    public function __construct($data = null){
        if(is_string($data)){
            $data = json_decode($data);
        }
        $data = (array) $data;

        parent::__construct($data);

        $this->account_id = isset($data['AccountId']) ? $data['AccountId'] : null;
        $this->subscription_id = isset($data['SubscriptionId']) ? $data['SubscriptionId'] : null;
        $this->name = isset($data['Name']) ? $data['Name'] : null;
        $this->campaign_type_id = isset($data['CampaignTypeId']) ? $data['CampaignTypeId'] : null;
        $this->content_id = isset($data['ContentId']) ? $data['ContentId'] : null;
        if(isset($data['Content'])){
            if($data['Content'] instanceof Content){
                $this->content = $data['Content'];
            } else {
                $this->content = new Content($data['Content']);
            }
        }
        $this->session = isset($data['Session']) ? $data['Session'] : null;
        $this->session_length = isset($data['SessionLength']) ? $data['SessionLength'] : null;
        $this->user_data = isset($data['UserData']) ? $data['UserData'] : null;
        $this->single_use = isset($data['SingleUse']) ? $data['SingleUse'] : null;
        $this->single_use_content_id = isset($data['SingleUseContentId']) ? $data['SingleUseContentId'] : null;
    }
    
    /* Campaign factory method to create new Campaign entity.
     * @param $data {Campaign} || {array} || {JSON} New Campaign entity details.
     * @return {Campaign} new Campaign entity.
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
            "SubscriptionId" => $this->subscription_id,
            "Name" => $this->name,
            "CampaignTypeId" => $this->campaign_type_id,
            "ContentId" => $this->content_id,
            "Content" => $this->content->toArray(),
            "Session" => $this->session,
            "SessionLength" => $this->session_length,
            "UserData" => $this->user_data,
            "SingleUse" => $this->single_use,
            "SingleUseContentId" => $this->single_use_content_id,
        );
    }
    
    /* Creates the JSON string from current Campaign object.
     * @return {string} JSON string.
     */
    public function _json(){
        $hash = array(
            "Id" => $this->id,
            "AccountId" => $this->account_id,
            "SubscriptionId" => $this->subscription_id,
            "Name" => $this->name,
            "CampaignTypeId" => $this->campaign_type_id,
            "ContentId" => $this->content_id,
            "Session" => $this->session,
            "SessionLength" => $this->session_length,
            "UserData" => $this->user_data,
            "SingleUse" => $this->single_use,
            "SingleUseContentId" => $this->single_use_content_id
        );
        return json_encode($hash);
    }
}