<?php
namespace TrueDialogApi\Model;

/* Account factory and model entity.
 * extends Base.
 */
class Account extends Base{

    /* {string} The current status of the account. This is the soft delete status. */
    public $status;

    /* {int} The parent id of the current account. This will be null for the root account. */
    public $parent_id;

    /* {string} The name of the current account. This will be null for the root account. */
    public $name;

    /* {date} The date/time the account was created. */
    public $created;

    /* {bool} Whether callback is allowed for an account or not. */
    public $allow_callback;

    /* {string} Token that is used when making callbacks. When 3Seventy makes a callback this token will be sent along with that callback request. This token can be whatever GUID of your choosing. */
    public $callback_token;
    
    /* Constructs Account entity
     * @param $data {Account} || {array} || {JSON} New account entity details.
     * @return {Account} new Account entity.
     */
    public function __construct($data = null) {
        if($data !== null){
            if(is_string($data)){
              $data = json_decode($data);
            }
            $data = (array) $data;

            parent::__construct($data);

            $this->status = isset($data['Status']) ? $data['Status'] : null;
            $this->parent_id = isset($data['ParentId']) ? $data['ParentId'] : null;
            $this->name = isset($data['Name']) ? $data['Name'] : null;
            $this->created = isset($data['Created']) ? $data['Created'] : null;
            $this->allow_callback = isset($data['AllowCallback']) ? $data['AllowCallback'] : null;
            $this->callback_token = isset($data['CallbackToken']) ? $data['CallbackToken'] : null;
        }
    }
    
    /* Account factory method to create new Account entity.
     * @param $data {Account} || {array} || {JSON} New account entity details.
     * @return {Account} new Account entity.
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
            "Status" => $this->status,
            "ParentId" => $this->parent_id,
            "Name" => $this->name,
            "Created" => $this->created,
            "AllowCallback" => $this->allow_callback,
            "CallbackToken" => $this->callback_token,
        );
    }
    
    /* Creates the JSON string from current Account object.
     * @return {string} JSON string.
     */
    public function _json() {
        $hash = array(
            "Id" => $this->id,
            "Status" => $this->status,
            "ParentId" => $this->parent_id,
            "Name" => $this->name,
            "Created" => $this->created,
            "AllowCallback" => $this->allow_callback,
            "CallbackToken" => $this->callback_token,
        );
        return json_encode($hash);
    }
}