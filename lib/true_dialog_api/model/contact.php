<?php
namespace TrueDialogApi\Model;

/* Contact factory and model entity.
 * extends SoftDeletable.
 */
class Contact extends SoftDeletable {
    
    /* {string} The ID of the account that the contact is for. */
    public $account_id;
    
    /* {string} Mobile number if available. */
    public $phone_number;
    
    /* {string} Email address of the contact. */
    public $email;
    
    /* {array<ContactAttribute>} List of attributes of this contact. */
    public $attributes;
    
    /* {array<ContactSubscription>} List of subscriptions this contact is opted into. */
    public $subscriptions;
    
    /* Constructs Contact entity
     * @param $data {Contact} || {array} || {JSON} New Contact entity details.
     * @return {Contact} new Contact entity.
     */
    public function __construct($data = null) {
        if(is_string($data)){
          $data = json_decode($data);
        }
        $data = (array) $data;
        
        parent::__construct($data);
        
        $this->account_id = isset($data['AccountId']) ? $data['AccountId'] : null;
        $this->phone_number = isset($data['PhoneNumber']) ? $data['PhoneNumber'] : null;
        $this->email = isset($data['Email']) ? $data['Email'] : null;
        if( isset($data['Attributes']) && !empty($data['Attributes']) && is_array($data['Attributes']) ){
            foreach($data['Attributes'] as $attribute){
                if( $attribute instanceof ContactAttribute ){
                    $this->attributes[] = $attribute;
                } else {
                    $this->attributes[] = new ContactAttribute($attribute);
                }
            }
        }
        if( isset($data['Subscriptions']) && !empty($data['Subscriptions']) && is_array($data['Subscriptions']) ){
            foreach($data['Subscriptions'] as $subscription){
                if($subscription instanceof ContactSubscription){
                    $this->subscriptions = $subscription;
                } else {
                    $this->subscriptions[] = new ContactSubscription($subscription);
                }
            }
        }
        
        return $this;
    }
    
    /* Contact factory method to create new Contact entity.
     * @param $data {Contact} || {array} || {JSON} New Contact entity details.
     * @return {Contact} new Contact entity.
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
        $attributes = array();
        $subscriptions = array();
        if(is_array($this->attributes)){
            foreach($this->attributes as $attribute){
                $attributes[] = $attribute->toArray();
            }
        }
        if(is_array($this->subscriptions)){
            foreach($this->subscriptions as $subscription){
                $subscriptions[] = $subscription->toArray();
            }
        }
        return array(
            "PhoneNumber" => $this->phone_number,
            "Email" => $this->email,
            "Attributes" => $attributes,
            "Subscriptions" => $subscriptions,
        );
    }
    
    /* Addes attribute to current contact.
     * @param $attribute {ContactAttribute} Attribute to add.
     * @return {Contact} Contact with added attribute.
     */
    public function addAttribute(ContactAttribute $attribute){
        $this->attributes[] = $attribute;
        return $this;
    }
    
    /* Set attributes to current contact.
     * @param $attributes {array<ContactAttribute>} List of attributes to set.
     * @return {Contact} Contact with assigned attributes.
     */
    public function setAttributes(array $attributes){
        $this->attributes = $attributes;
        return $this;
    }
    
    /* Addes subscription to current contact.
     * @param $subscription {ContactSubscription} Subscription to add.
     * @return {Contact} Contact with added subscription.
     */
    public function addSubscription(ContactSubscription $subscription){
        $this->subscriptions[] = $subscription;
        return $this;
    }
    
    /* Set subscriptions to current contact.
     * @param $subscriptions {array<ContactSubscription>} List of subscriptions to set.
     * @return {Contact} Contact with assigned subscriptions.
     */
    public function setSubscriptions(array $subscriptions){
        $this->subscriptions = $subscriptions;
    }
    
    /* Creates the JSON string from current Contact object.
     * @return {string} JSON string.
     */
    public function _json() {
        $hash = array(
            "Id" => $this->id,
            "AccountId" => $this->account_id,
            "PhoneNumber" => $this->phone_number,
            "Email" => $this->email,
            "Attributes" => $this->attributes,
            "Subscriptions" => $this->subscriptions
        );
        return json_encode($hash);
    }
}