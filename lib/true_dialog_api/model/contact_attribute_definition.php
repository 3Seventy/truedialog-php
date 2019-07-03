<?php
namespace TrueDialogApi\Model;

/* ContactAttributeDefinition factory and model entity.
 * extends BaseAudited.
 */
class ContactAttributeDefinition extends BaseAudited {
    /* {int} The ID of the data type for this attribute. */
    public $data_type_id;
    
    /* {int} The Id of category. */
    public $category_id;
    
    /* {string} Name of the attribute definition. */
    public $name;
    
    /* {string} A full description of this attribute. */
    public $description;

    /* Constructs ContactAttributeDefinition entity
     * @param $data {ContactAttributeDefinition} || {array} || {JSON} New ContactAttributeDefinition entity details.
     * @return {ContactAttributeDefinition} new ContactAttributeDefinition entity.
     */
    public function __construct($data = null) {
        if(is_string($data)){
          $data = json_decode($data);
        }
        $data = (array) $data;
        
        parent::__construct($data);
        
        $this->data_type_id = isset($data['DataTypeId']) ? $data['DataTypeId'] : null;
        $this->category_id = isset($data['CategoryId']) ? $data['CategoryId'] : null;
        $this->name = isset($data['Name']) ? $data['Name'] : null;
        $this->description = isset($data['Description']) ? $data['Description'] : null;
    }

    /* ContactAttributeDefinition factory method to create new ContactAttributeDefinition entity.
     * @param $data {ContactAttributeDefinition} || {array} || {JSON} New ContactAttributeDefinition entity details.
     * @return {ContactAttributeDefinition} new ContactAttributeDefinition entity.
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
            "DataTypeId" => $this->data_type_id,
            "CategoryId" => $this->category_id,
            "Name" => $this->name,
            "Description" => $this->description,
        );
    }
    
    /* Creates the JSON string from current ContactAttributeDefinition object.
     * @return {string} JSON string.
     */
    public function _json(){
        $hash = array(
            "Id" => $this->id,
            "DataTypeId" => $this->data_type_id,
            "CategoryId" => $this->category_id,
            "Name" => $this->name,
            "Description" => $this->description,
        );
        return json_encode($hash);
    }
}