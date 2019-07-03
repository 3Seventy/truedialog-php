<?php
namespace TrueDialogApi\Model;

use TrueDialogApi\Model\ContentTemplate;

/* Content factory and model entity.
 * extends BaseAudited.
 */
class Content extends BaseAudited {
    
    /* {int} The account ID which owns the content group. */
    public $account_id;
    
    /* {string} The name of the content. */
    public $name;
    
    /* {string} Addtional description data. */
    public $description;
    
    /* {array<ContentTemplates>} List of templates attached to the content item. */
    public $templates;

    /* Constructs Content entity
     * @param $data {Content} || {array} || {JSON} New Content entity details.
     * @return {Content} new Content entity.
     */
    public function __construct($data = null) {
        if(is_string($data)){
          $data = json_decode($data);
        }
        $data = (array) $data;
        
        parent::__construct($data);
        
        $this->account_id = isset($data['AccountId']) ? $data['AccountId'] : null;
        $this->name = isset($data['Name']) ? $data['Name'] : null;
        $this->description = isset($data['Description']) ? $data['Description'] : null;
        if( isset($data['Templates']) && !empty($data['Templates']) && is_array($data['Templates']) ){
            foreach($data['Templates'] as $template){
                if($template instanceof ContentTemplate){
                    $this->templates[] = $template;
                } else {
                    $this->templates[] = new ContentTemplate($template);
                }
            }
        }
    }
    
    /* Content factory method to create new Content entity.
     * @param $data {Content} || {array} || {JSON} New Content entity details.
     * @return {Content} new Content entity.
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
        $templates = array();
        if(is_array($this->templates)){
            foreach($this->templates as $template){
                $templates = $template->toArray();
            }
        }
        return array(
            "Name" => $this->name,
            "Description" => $this->description,
            "Templates" => $templates,
        );
    }
    
    /* Addes template to current contact.
     * @param $template {ContentTemplate} Template to add.
     * @return {Content} Content with added template.
     */
    public function addTemplate(ContentTemplate $template){
        $this->templates[] = $template;
        return $this;
    }
    
    /* Set templates to current contact.
     * @param $templates {array<ContentTemplate>} List of templates to set.
     * @return {Content} Content with assigned templates.
     */
    public function setTemplates(array $templates){
        $this->templates = $templates;
    }
    
    /* Creates the JSON string from current Content object.
     * @return {string} JSON string.
     */
    public function _json(){
        $hash = array(
            "Id" => $this->id,
            "AccountId" => $this->account_id,
            "Name" => $this->name,
            "Description" => $this->description,
            "Templates" => $this->templates
        );
        return json_encode($hash);
    }
}