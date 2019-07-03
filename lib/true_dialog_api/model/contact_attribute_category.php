<?php
namespace TrueDialogApi\Model;

/* ContactAttributeCategory factory and model entity.
 * extends Base.
 */
class ContactAttributeCategory extends Base {
    
    /* {string} ContactAttributeCategory name. */
    public $name;
    
    /* {string} ContactAttributeCategory description. */
    public $description;

    /* Constructs ContactAttributeCategory entity
     * @param $data {ContactAttributeCategory} || {array} || {JSON} New ContactAttributeCategory entity details.
     * @return {ContactAttributeCategory} new ContactAttributeCategory entity.
     */
    public function __construct($data = null) {
        if(is_string($data)){
          $data = json_decode($data);
        }
        $data = (array) $data;
        
        parent::__construct($data);
        
        $this->name = isset($data['Name']) ? $data['Name'] : null;
        $this->description = isset($data['Description']) ? $data['Description'] : null;
    }

    /* ContactAttributeCategory factory method to create new ContactAttributeCategory entity.
     * @param $data {ContactAttributeCategory} || {array} || {JSON} New ContactAttributeCategory entity details.
     * @return {ContactAttributeCategory} new ContactAttributeCategory entity.
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
            "Description" => $this->description,
        );
    }
    
    /* Creates the JSON string from current ContactAttributeCategory object.
     * @return {string} JSON string.
     */
    public function _json(){
        $hash = array(
            "Id" => $this->id,
            "Name" => $this->name,
            "Description" => $this->description
        );
        return json_encode($hash);
    }
}