<?php
namespace TrueDialogApi\Model;

/* Base class for objects with audit information.
 * Extends the Base class.
 */
class BaseAudited extends Base {
  
    /* {date} The resource creation date/time. */
    public $created;

    /* {int} The person who created the resource. */
    public $created_by;

    /* {date} The date/time when the resource was modified. */
    public $modified;

    /* {date} The person who modified the resource. */
    public $modified_by;
    
    /* Constructs BaseAudited entity
     * @param $data {BaseAudited} || {array} || {JSON} New autidet base entity details.
     * @return {BaseAudited} new BaseAudited entity.
     */
    public function __construct($data = null) {
        if(is_string($data)){
          $data = json_decode($data);
        }
        $data = (array) $data;
        
        parent::__construct($data);
        
        $this->created = isset($data['Created']) ? $data['Created'] : null;
        $this->modified = isset($data['Modified']) ? $data['Modified'] : null;
        $this->created_by = isset($data['CreatedBy']) ? $data['CreatedBy'] : null;
        $this->modified_by = isset($data['ModifiedBy']) ? $data['ModifiedBy'] : null;
    }
    
    /* Creates the JSON string from current BaseAudited object.
     * @return {string} JSON string.
     */
    public function _json() {
        $hash = array(
            "Id" => $this->id,
            "Created" => $this->created,
            "CreatedBy" => $this->created_by,
            "Modified" => $this->modified,
            "ModifiedBy" => $this->modified_by
        );
        return json_encode($hash);
    }
}