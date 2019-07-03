<?php
namespace TrueDialogApi\Model;

/* ContentTemplate factory and model entity.
 * extends BaseAudited.
 */
class ContentTemplate extends BaseAudited {
    
    /* {int} The account ID which owns the content group. */
    public $account_id;
    
    /* {int} The content group which the template is contained within. */
    public $content_id;
    
    /* {int} The language this template is for. */
    public $language_id;
    
    /* {int} The type of channel this content can be sent to. */
    public $channel_type_id;
    
    /* {int} The format of the tempalte data. */
    public $encoding_type_id;
    
    /* {string} The actual template. */
    public $template;

    /* Constructs ContentTemplate entity
     * @param $data {ContentTemplate} || {array} || {JSON} New ContentTemplate entity details.
     * @return {ContentTemplate} new ContentTemplate entity.
     */
    public function __construct($data = null) {
        if(is_string($data)){
          $data = json_decode($data);
        }
        $data = (array) $data;
        
        parent::__construct($data);
        
        $this->account_id = isset($data['AccountId']) ? $data['AccountId'] : null;
        $this->content_id = isset($data['ContentId']) ? $data['ContentId'] : null;
        $this->language_id = isset($data['LanguageId']) ? $data['LanguageId'] : null;
        $this->channel_type_id = isset($data['ChannelTypeId']) ? $data['ChannelTypeId'] : null;
        $this->encoding_type_id = isset($data['EncodingTypeId']) ? $data['EncodingTypeId'] : null;
        $this->template = isset($data['Template']) ? $data['Template'] : null;
    }
    
    /* ContentTemplate factory method to create new ContentTemplate entity.
     * @param $data {ContentTemplate} || {array} || {JSON} New ContentTemplate entity details.
     * @return {ContentTemplate} new ContentTemplate entity.
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
            "ContentId" => $this->content_id,
            "LanguageId" => $this->language_id,
            "ChannelTypeId" => $this->channel_type_id,
            "EncodingTypeId" => $this->encoding_type_id,
            "Template" => $this->template,
        );
    }
    
    /* Creates the JSON string from current ContentTemplate object.
     * @return {string} JSON string.
     */
    public function _json(){
      $hash = array(
        "Id" => $this->id,
        "AccountId" => $this->account_id,
        "ContentId" => $this->content_id,
        "LanguageId" => $this->language_id,
        "ChannelTypeId" => $this->channel_type_id,
        "EncodingTypeId" => $this->encoding_type_id,
        "Template" => $this->template
      );
      return json_encode($hash);
    }
}