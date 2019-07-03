<?php
namespace TrueDialogApi\Model;

/* ContactSubscription factory and model entity.
 * extends Base.
 */
class ContactSubscription extends Base{
    
    /* {int} The ID of the contact that is opted in. */
    public $contact_id;
    
    /* {int} The subscription ID which the contact is opted into. */
    public $subscription_id;
    
    /* {bool} True if we can send an SMS to this contact on this subscription.  */
    public $sms_enabled;
    
    /* {bool} True if we can send a MMS to this contact on this subscription. */
    public $mms_enabled;
    
    /* {bool} True if we can send an email to this contact on this subscription. */
    public $email_enabled;
    
    /* {bool} True if we can send a voice message to this contact on this subscription. */
    public $voice_enabled;
    
    
    /* Constructs ContactSubscription entity
     * @param $data {ContactSubscription} || {array} || {JSON} New ContactSubscription entity details.
     * @return {ContactSubscription} new ContactSubscription entity.
     */
    public function __construct($data = null) {
        if(is_string($data)){
          $data = json_decode($data);
        }
        $data = (array) $data;
        
        parent::__construct($data);
        
        $this->contact_id = isset($data['ContactId']) ? $data['ContactId'] : null;
        $this->subscription_id = isset($data['SubscriptionId']) ? $data['SubscriptionId'] : null;
        $this->sms_enabled = isset($data['SmsEnabled']) ? $data['SmsEnabled'] : null;
        $this->mms_enabled = isset($data['MmsEnabled']) ? $data['MmsEnabled'] : null;
        $this->email_enabled = isset($data['EmailEnabled']) ? $data['EmailEnabled'] : null;
        $this->voice_enabled = isset($data['VoiceEnabled']) ? $data['VoiceEnabled'] : null;
    }
    
    /* ContactSubscription factory method to create new ContactSubscription entity.
     * @param $data {ContactSubscription} || {array} || {JSON} New ContactSubscription entity details.
     * @return {ContactSubscription} new ContactSubscription entity.
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
            "ContactId" => $this->contact_id,
            "SubscriptionId" => $this->subscription_id,
            "SmsEnabled" => $this->sms_enabled,
            "MmsEnabled" => $this->mms_enabled,
            "EmailEnabled" => $this->email_enabled,
            "VoiceEnabled" => $this->voice_enabled,
        );
    }
    
    /* Creates the JSON string from current ContactSubscription object.
     * @return {string} JSON string.
     */
    public function _json(){
        $hash = array(
            "Id" => $this->id,
            "ContactId" => $this->contact_id,
            "SubscriptionId" => $this->subscription_id,
            "SmsEnabled" => $this->sms_enabled,
            "MmsEnabled" => $this->mms_enabled,
            "EmailEnabled" => $this->email_enabled,
            "VoiceEnabled" => $this->voice_enabled
        );
        return json_encode($hash);
    }
}