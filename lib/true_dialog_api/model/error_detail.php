<?php
namespace TrueDialogApi\Model;

/* ErrorDetail model entity. */
class ErrorDetail {
    
    /* {int} Numeric error code. */
    public $error_code_id;
    
    /* {string} Error message. */
    public $error_message;
    
    /* {string} Type of an object that causes error. */
    public $object_type;
    
    /* {string} Name of the propery that causes error. */
    public $property_name;

    /* Constructs ErrorDetail entity
     * @param $data {ErrorDetail} || {array} || {JSON} New ErrorDetail entity details.
     * @return {ErrorDetail} new ErrorDetail entity.
     */
    public function __construct($data = null) {
        if(is_string($data)){
          $data = json_decode($data);
        }
        $data = (array) $data;
        
        $this->error_code_id = isset($data['ErrorCodeId']) ? $data['ErrorCodeId'] : null;
        $this->error_message = isset($data['ErrorMessage']) ? $data['ErrorMessage'] : null;
        $this->object_type = isset($data['ObjectType']) ? $data['ObjectType'] : null;
        $this->property_name = isset($data['PropertyName']) ? $data['PropertyName'] : null;
    }
    
    /* Creates the JSON string from current ErrorDetail object.
     * @return {string} JSON string.
     */
    public function _json(){
        $hash = array(
            "Id" => $this->id,
            "ErrorCodeId" => $this->error_code_id,
            "ErrorMessage" => $this->error_message,
            "ObjectType" => $this->object_type,
            "PropertyName" => $this->property_name
        );
        return json_encode($hash);
    }
}