<?php
namespace TrueDialogApi\Model;

/* Base class. */
class Base {
  
    /* {int} The primary key of the model. */
    public $id;

    /* Constructs Base entity
     * @param $data {Base} || {array} || {JSON} New base entity details.
     * @return {Base} new Base entity.
     */
    public function __construct($data = null) {
        if(is_string($data)){
          $data = json_decode($data);
        }
        $data = (array) $data;
        /* ID HOOK FOR CONTENT (MUST BE FIXED) */
        
        $id = null;
        if(isset($data['id'])) $id = $data['id'];
        $this->id = $id;
        
        /* ID HOOK FOR CONTENT (MUST BE FIXED) */
        // $this->id = isset($data['Id']) ? $data['Id'] : null;
    }
    
    /* Gets ID of the entity
     * @return {int} Entity ID.
     */
    public function getId(){
        return $this->id;
    }
    
    /* Creates the JSON string from current Base object.
     * @return {string} JSON string.
     */
    public function _json(){
        $hash = array(
            "Id" => $this->id
        );
        return json_encode($hash);
    }
}