<?php
namespace TrueDialogApi\Model;

/* Keyword factory and model entity.
 * extends SoftDeletable.
 */
class Keyword extends SoftDeletable {
    
    /* {int} The account that will owns the keyword. */
    public $account_id;
    
    /* {int} The channel that the keyword responds on. */
    public $channel_id;
    
    /* {string} The name of the keyword to reserve. */
    public $name;
        
    /* {bool} Boolean to specify if the client requires a callback when this keyword is texted in. */
    public $callback_required;

    /* Constructs Keyword entity
     * @param $data {Keyword} || {array} || {JSON} New Keyword entity details.
     * @return {Keyword} new Keyword entity.
     */
    public function __construct($data = null) {
        if(is_string($data)){
          $data = json_decode($data);
        }
        $data = (array) $data;
        
        parent::__construct($data);
        
        $this->account_id = isset($data['AccountId']) ? $data['AccountId'] : null;
        $this->channel_id = isset($data['ChannelId']) ? $data['ChannelId'] : null;
        $this->name = isset($data['Name']) ? $data['Name'] : null;
        $this->callback_required = isset($data['CallbackRequired']) ? $data['CallbackRequired'] : null;
    }
    
    /* Keyword factory method to create new Keyword entity.
     * @param $data {Keyword} || {array} || {JSON} New Keyword entity details.
     * @return {Keyword} new Keyword entity.
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
            "ChannelId" => $this->channel_id,
            "Name" => $this->name,
            "CallbackRequired" => $this->callback_required,
        );
    }
    
    /* Creates the JSON string from current Keyword object.
     * @return {string} JSON string.
     */
    public function _json(){
        $hash = array(
            "Id" => $this->id,
            "AccountId" => $this->account_id,
            "ChannelId" => $this->channel_id,
            "Name" => $this->name,
            "CallbackRequired" => $this->callback_required
        );
        return json_encode($hash);
    }
}