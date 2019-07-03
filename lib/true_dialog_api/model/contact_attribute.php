<?php
namespace TrueDialogApi\Model;

/* ContactAttribute factory and model entity.
 * extends Base.
 */
class ContactAttribute extends Base {
    
    /* {string} Attribute name. */
    public $name;
    /* {string} Attribute value. */
    public $value;

    /* Constructs ContactAttribute entity
     * @param $data {ContactAttribute} || {array} || {JSON} New ContactAttribute entity details.
     * @return {ContactAttribute} new ContactAttribute entity.
     */
    public function __construct($data = null) {
        if(is_string($data)){
          $data = json_decode($data);
        }
        $data = (array) $data;
        
        parent::__construct($data);
        
        $this->name = isset($data['Name']) ? $data['Name'] : null;
        $this->value = isset($data['Value']) ? $data['Value'] : null;
    }

    /* ContactAttribute factory method to create new ContactAttribute entity.
     * @param $data {ContactAttribute} || {array} || {JSON} New ContactAttribute entity details.
     * @return {ContactAttribute} new ContactAttribute entity.
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
    
    /* Creates the JSON string from current ContactAttribute object.
     * @return {string} JSON string.
     */
    public function _json(){
        $hash = array(
            "Id" => $this->id,
            "Name" => $this->name,
            "Value" => $this->value
        );
        return json_encode($hash);
    }
}

