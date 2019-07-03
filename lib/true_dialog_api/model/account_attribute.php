<?php
namespace TrueDialogApi\Model;

/* AccountAttribute factory and model entity.
 * extends Base.
 */
class AccountAttribute extends Base{

    /* {int} The account to which the attribute belongs. */
    public $account_id;

    /* {string} The name or ID of the value. */
    public $name;

    /* {string} The value of an attribute. */
    public $value;

    /* Constructs AccountAttribute entity
     * @param $data {AccountAttribute} || {array} || {JSON} New account entity details.
     * @return {AccountAttribute} New AccountAttribute entity.
     */
    public function __construct($data = null) {
        if($data !== null){
            if(is_string($data)){
              $data = json_decode($data);
            }
            $data = (array) $data;

            parent::__construct($data);

            $this->account_id = isset($data['AccountId']) ? $data['AccountId'] : null;
            $this->name = isset($data['Name']) ? $data['Name'] : null;
            $this->value = isset($data['Value']) ? $data['Value'] : null;
        }
    }
    
    /* AccountAttribute factory method to create new AccountAttribute entity.
     * @param $data {AccountAttribute} || {array} || {JSON} New account entity details.
     * @return {AccountAttribute} new AccountAttribute entity.
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
            "Value" => $this->value,
        );
    }
    
    /* Creates the JSON string from current AccountAttribute object.
     * @return {string} JSON string.
     */
    public function _json() {
        $hash = array(
            "Id" => $this->id,
            "AccountId" => $this->account_id,
            "Name" => $this->name,
            "Value" => $this->value,
        );
        return json_encode($hash);
    }
}