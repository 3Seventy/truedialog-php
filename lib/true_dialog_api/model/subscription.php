<?php
namespace TrueDialogApi\Model;

/* Subscription factory and model entity.
 * extends SoftDeletable.
 */
class Subscription extends SoftDeletable {
    
    /* {int} The account that owns the subscription. */
    public $account_id;
    
    /* {string} Name of the subscription. */
    public $name;
    
    /* {string} Pretty display name of the subscription. */
    public $label;
    
    /* {int} The type of subscription, either one-time or recurring. */
    public $subscription_type_id;
    
    /* {int} Number of messages sent per month. */
    public $frequency;

    /* Constructs Subscription entity
     * @param $data {Subscription} || {array} || {JSON} New Subscription entity details.
     * @return {Subscription} New Subscription entity.
     */
    public function __construct($data = null) {
        if(is_string($data)){
            $data = json_decode($data);
        }
        $data = (array) $data;
        
        parent::__construct($data);
        
        $this->account_id = isset($data['AccountId']) ? $data['AccountId'] : null;
        $this->name = isset($data['Name']) ? $data['Name'] : null;
        $this->label = isset($data['Label']) ? $data['Label'] : null;
        $this->subscription_type_id = isset($data['SubscriptionTypeId']) ? $data['SubscriptionTypeId'] : null;
        $this->frequency = isset($data['Frequency']) ? $data['Frequency'] : 30;
    }

    /* Subscription factory method to create new Subscription entity.
     * @param $data {Subscription} || {array} || {JSON} New Subscription entity details.
     * @return {Subscription} new Subscription entity.
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
            "Name" => $this->name,
            "Label" => $this->label,
            "SubscriptionTypeId" => $this->subscription_type_id,
            "Frequency" => $this->frequency,
        );
    }
    
    /* Creates the JSON string from current Subscription object.
     * @return {string} JSON string.
     */
    public function _json(){
        $hash = array(
            "Id" => $this->id,
            "AccountId" => $this->account_id,
            "Name" => $this->name,
            "Label" => $this->label,
            "SubscriptionTypeId" => $this->subscription_type_id,
            "Frequency" => $this->frequency
        );
        return json_encode($hash);
    }
}