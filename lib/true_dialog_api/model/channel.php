<?php
namespace TrueDialogApi\Model;

/* Channel factory and model entity.
 * extends Base.
 */
class Channel extends Base {

    /* {int} The ID of channel's type. */
    public $type_id;

    /* {string} The channel name. */
    public $name;

    /* {string} The channel's label. */
    public $label;

    /* {string} The channel's description. */
    public $description;

    /* {int} The Id of default channel's language. */
    public $default_language_id;

    /* {bool} whether channel is active or not. */
    public $is_active;

    /* {string} The override group. */
    public $override_group;

    /* Constructs Channel entity
     * @param $data {Channel} || {array} || {JSON} New Channel entity details.
     * @return {Channel} new Channel entity.
     */
    public function __construct($data = null) {
        if(is_string($data)){
          $data = json_decode($data);
        }
        
        $data = (array) $data;
        
        parent::__construct($data);
        
        $this->type_id = isset($data['type']) ? $data['type'] : null;
        $this->name = isset($data['Name']) ? $data['Name'] : null;
        $this->label = isset($data['Label']) ? $data['Label'] : null;
        $this->description = isset($data['Description']) ? $data['Description'] : null;
        $this->default_language_id = isset($data['DefaultLanguageId']) ? $data['DefaultLanguageId'] : null;
        $this->is_active = isset($data['IsActive']) ? $data['IsActive'] : false;
        $this->override_group = isset($data['OverrideGroup']) ? $data['OverrideGroup'] : null;
    }
    
    /* Channel factory method to create new Channel entity.
     * @param $data {Channel} || {array} || {JSON} New Channel entity details.
     * @return {Channel} new Channel entity.
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
            "type" => $this->type_id,
            "Name" => $this->name,
            "Label" => $this->label,
            "Description" => $this->description,
            "DefaultLanguageId" => $this->default_language_id,
            "IsActive" => $this->is_active,
            "OverrideGroup" => $this->override_group,
        );
    }
    
    /* Creates the JSON string from current Channel object.
     * @return {string} JSON string.
     */
    public function _json(){
        $hash = array(
            "Id" => $this->id,
            "type" => $this->type_id,
            "Name" => $this->name,
            "Label" => $this->label,
            "Description" => $this->description,
            "DefaultLanguageId" => $this->default_language_id,
            "IsActive" => $this->is_active,
            "OverrideGroup" => $this->override_group
        );
        return json_encode($hash);
    }
}