<?php
namespace TrueDialogApi\Model;

/* Base class for items that are not actually removed from the database 
 * Instead these are marked as being inactive when you delete them.
 * Extends the BaseAudited class.
 */
class SoftDeletable extends BaseAudited {
    
    /* {int} ID of current entityt status. */
    public $status_id;
    
    /* Constructs SoftDeletable entity
     * @param $data {SoftDeletable} || {array} || {JSON} New SoftDeletable entity details.
     * @return {SoftDeletable} new SoftDeletable entity.
     */
    public function __construct($data = null) {
        if(is_string($data)){
          $data = json_decode($data);
        }
        $data = (array) $data;
        
        parent::__construct($data);
        
        $this->status_id = isset($data['StatusId']) ? $data['StatusId'] : null;
    }
    
    /* Creates the JSON string from current SoftDeletable object.
     * @return {string} JSON string.
     */
    public function _json(){
        $hash = array(
            "Id" => $this->id,
            "StatusId" => $this->status_id,
        );
        return json_encode($hash);
    }
}