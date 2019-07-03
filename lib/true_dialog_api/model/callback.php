<?php
namespace TrueDialogApi\Model;

/* Callback factory and model entity.
 * extends Base.
 */
class Callback extends Base{

    /* {int} The account_id to which this callback occurs. */
    public $account_id;

    /* {int} The type of event which will trigger the callback. Different callback types will send different sets of data. */
    public $callback_type;

    /* {string} The URL that will be called when the callback type event occurs. */
    public $url;

    /* {bool} The control to turn on/off the callback. */
    public $is_active;

    /* Constructs Callback entity
     * @param $data {Callback} || {array} || {JSON} New callback entity details.
     * @return {Callback} new Callback entity.
     */
    public function __construct($data = null) {
        if(is_string($data)){
          $data = json_decode($data);
        }
        $data = (array) $data;
        
        parent::__construct($data);
        
        $this->account_id = isset($data['AccountId']) ? $data['AccountId'] : null;
        $this->callback_type = isset($data['CallbackType']) ? $data['CallbackType'] : null;
        $this->url = isset($data['URL']) ? $data['URL'] : null;
        $this->is_active = isset($data['Active']) ? $data['Active'] : null;
    }    
    
    /* Callback factory method to create new Callback entity.
     * @param $data {Callback} || {array} || {JSON} New Callback entity details.
     * @return {Callback} new Callback entity.
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
            "CallbackType" => $this->callback_type,
            "URL" => $this->url,
            "Active" => $this->is_active,
        );
    }
    
    /* Creates the JSON string from current Callback object.
     * @return {string} JSON string.
     */
    public function _json(){
        $hash = array(
            "Id" => $this->id,
            "AccountId" => $this->account_id,
            "CallbackType" => $this->callback_type,
            "URL" => $this->url,
            "Active" => $this->is_active
        );
        return json_encode($hash);
    }
}