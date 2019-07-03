<?php

namespace TrueDialogApi\Api;

use TrueDialogApi\Helpers\Request;
use TrueDialogApi\Helpers\Url;
use TrueDialogApi\Model\Content as ContentModel;
use TrueDialogApi\Model\ContentTemplate;
use TrueDialogApi\Model\ErrorDetail;

/* Repository entity. Allows user to get access to Content, ContentTemplate actions.
 * @see content https://api.truedialog.com/docs/v2.1/RestApi/EndpointList/41
 * @see content template https://api.truedialog.com/docs/v2.1/RestApi/EndpointList/42
 */
class Content {

    /* {Request} Request object to perform calls with. */
    private $request;

    public function __construct() {
        $this->request = new Request();
    }

    /* Creates a new content group.
     * @param $payload {Content} || {array} || {JSON} The details about the new content group.
     * @return {Content} New content details.
     * @error {ErrorDetail} Details about error happend.
     */
    public function add($payload){
        if($payload instanceof ContentModel)
            $payload = $payload->toArray();
        $response = $this->request->post(Url::url_(array("content")), $payload);
        if($response instanceof ErrorDetail){
            return $response;
        }
        return new ContentModel($response);
    }

    /* Gets a specific content group object.
     * @param $content_id {int} The ID of the content group to get.
     * @param $validated {bool} Set true to throw error if there is no account with specified id otherwise it returns NULL.
     * @return {Content} Content with specified ID.
     * @error {ErrorDetail} Details about error happend.
     */
    public function get($content_id, $validated = false){
       $response = $this->request->get(Url::url_(array("content", $content_id)), $validated);
       if($response instanceof ErrorDetail){
           return $response;
       }
       if(empty($response)){
           return null;
       }
       $content = new ContentModel($response);
       $this->loadTemplates($content);
       return $content;
    }
    
    /* Updates details about a content group.
     * @param $content_id {int} The ID of the content group.
     * @param $paylod {Content} || {array} || {JSON} New details for the content group.
     * @return {Content} Updated content details.
     * @error {ErrorDetail} Details about error happend.
     */
    public function edit($content_id, $payload){
        if($payload instanceof ContentModel)
            $payload = $payload->toArray();
        $response = $this->request->put(Url::url_(array("content", $content_id)), $payload);
        if($response instanceof ErrorDetail){
            return $response;
        }
        return new ContentModel($response);
    }

    /* Deletes a content group.
     * @param $content_id {int} The ID of the content group to remove.
     * @return NULL.
     * @error {ErrorDetail} Details about error happend.
     */
    public function delete($content_id){
        $response = $this->request->delete(Url::url_(array("content", $content_id)));
        if($response instanceof ErrorDetail){
            return $response;
        }
        return null;
    }

    /* Lists all content group objects on an account.
     * @return {array<Content>} List of content object on an account.
     * @error {ErrorDetail} Details about error happend.
     */
    public function getAll(){
        $response = $this->request->get(Url::url_(array("content")));
        if($response instanceof ErrorDetail){
            return $response;
        }
        $result = array();
        $contents = json_decode($response);
        if(is_array($contents)){
            foreach($contents as $resp){
                $result[] = new ContentModel($resp);
            }
        }
        return $result;
    }
    
    /* Loads templates to content object.
     * @param $content {Content} Content object to assign templates to.
     * @return {Content} Content object with loaded templates.
     * @error {ErrorDetail} Details about error happend.
     */
    public function loadTemplates(ContentModel &$content){
        $content_id = $content->getId();
        $response = $this->request->get(Url::url_(array("content", $content_id, "template")));
        if($response instanceof ErrorDetail){
            return $response;
        }
        $result = array();
        $templates = json_decode($response);
        if(is_array($templates)){
            foreach ($templates as $item){
                $result[] = new ContentTemplate($item);
            }
        }
        $content->setTemplates($result);
        return $result;
    }
    
    /* Returns all templates on a content group.
     * @param $content_id {int} The content group which the templates are contained within.
     * @return {array<ContentTemplate>} List of all templates of specified content.
     * @error {ErrorDetail} Details about error happend.
     */
    public function getAllTemplates($content_id){
        $response = $this->request->get(Url::url_(array("content", $content_id, "template")));
        if($response instanceof ErrorDetail){
            return $response;
        }
        $result = array();
        $templates = json_decode($response);
        if(is_array($templates)){
            foreach ($templates as $item){
                $result[] = new ContentTemplate($item);
            }
        }
        return $result;
    }
    
    /* Gets a single template from within a content group.
     * @param $content_id {int} The content group which the template is contained within.
     * @param @template_id {int} The specific template ID to get.
     * @param $validated {bool} Set true to throw error if there is no account with specified id otherwise it returns NULL.
     * @return {ContentTemplate} Template with specified ID.
     * @error {ErrorDetail} Details about error happend.
     */
    public function getTemplate($content_id, $template_id, $validated = false){
        $response = $this->request->get(Url::url_(array("content", $content_id, "template", $template_id)), $validated);
        if($response instanceof ErrorDetail){
            return $response;
        }
        if($response === null){
            return null;
        }
        return new ContentTemplate($response);
    }
    
    /* Creates a new template for a content group. Note that you can only have one template per supported language type.
     * @param $content_id {int} The content group which the template will be contained within.
     * @param $payload {ContentTemplate} || {array} || {JSON} Details of the new template's format.
     * @return {ContentTemplate} New content template details.
     * @error {ErrorDetail} Details about error happend.
     */
    public function addTemplate($content_id, $payload){
        if($payload instanceof ContentTemplate)
            $payload = $payload->toArray();
        $response = $this->request->post(Url::url_(array("content", $content_id, "template")), $payload);
        if($response instanceof ErrorDetail){
            return $response;
        }
        return new ContentTemplate($response);
    }
    
    /* Updates a template to a new format.
     * @param $content_id {int} The content group which the template is contained within.
     * @param $template_id {int} The specific template ID to update.
     * @param $payload {ContentTemplate} || {array} || {JSON} Details of the template's new format.
     * @return {ContentTemplate} Updated content template details.
     * @error {ErrorDetail} Details about error happend.
     */
    public function editTemplate($content_id, $template_id, $payload){
        if($payload instanceof ContentTemplate)
            $payload = $payload->toArray();
        $response = $this->request->put(Url::url_(array("content", $content_id, "template", $template_id)), $payload);
        if($response instanceof ErrorDetail){
            return $response;
        }
        return new ContentTemplate($response);
    }
    
    /* Removes a template from a content group.
     * @param $content_id {int} The content group which the template is contained within.
     * @param $template_id {int} The specific template ID to remove.
     * @return NULL.
     * @error {ErrorDetail} Details about error happend.
     */
    public function deleteTemplate($content_id, $template_id){
        $response = $this->request->delete(Url::url_(array("content", $content_id, "template", $template_id)));
        if($response instanceof ErrorDetail){
            return $response;
        }
        return null;
    }
}