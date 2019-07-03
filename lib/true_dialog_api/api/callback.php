<?php
namespace TrueDialogApi\Api;

use TrueDialogApi\Helpers\Request;
use TrueDialogApi\Helpers\Url;
use TrueDialogApi\Model\Callback as CallbackModel;
use TrueDialogApi\Model\ErrorDetail;

/* Repository entity. Allows user to get access to Callback actions.
 * @see https://api.truedialog.com/docs/v2.1/RestApi/EndpointList/15
 */
class Callback {
    
    /* {Request} Request object to perform calls with. */
    private $request;
    
    public function __construct() {
        $this->request = new Request();
    }
    
    /* Gets a list of all callbacks for an account.
     * @return {array<Callback>} List of callbacks for current account.
     * @error {ErrorDetail} Details about error happend.
     */
    public function getAll(){
        $response = $this->request->get(Url::url_(array("callback")));
        if($response instanceof ErrorDetail){
            return $response;
        }
        $result = array();
        $callbacks = json_decode($response);
        if(is_array($callbacks)){
            foreach($callbacks as $item){
                $result[] = new CallbackModel($item);
            }
        }
        return $result;
    }
    
    /* Returns the details for a specific callback object.
     * @param $callback_id {int} The ID of the callback to return.
     * @param $validated {bool} Set true to throw error if there is no account with specified id otherwise it returns NULL.
     * @return {Callback} Callback with specified ID.
     * @error {ErrorDetail} Details about error happend.
     */
    public function get($callback_id, $validated = false){
        $response = $this->request->get(Url::url_(array("callback", $callback_id)), $validated);
        if($response instanceof ErrorDetail)
            return $response;
        if(empty($response)){
            return null;
        }
        return new CallbackModel($response);
    }

    /* Creates a new callback object.
     * @param $payload {Callback} || {array} || {JSON} The new subscriptions details.
     * @return {Callback} New callback details.
     * @error {ErrorDetail} Details about error happend.
     */
    public function add($payload){
        if($payload instanceof CallbackModel)
            $payload = $payload->toArray();
        $response = $this->request->post(Url::url_(array("callback")), $payload);
        if($response instanceof ErrorDetail){
            return $response;
        }
        return new CallbackModel($response);
    }

    /* Removes a callback object. Note that it is possible to prevent a callback from
     *  being triggered temporarily without deleting it by setting that callbacks "active" flag to false.
     * @param $callback_id {int} The ID of the callback object to remove.
     * @return NULL.
     * @error {ErrorDetail} Details about error happend.
     */
    public function delete($callback_id){
        $response = $this->request->delete(Url::url_(array("callback", $callback_id)));
        if($response instanceof ErrorDetail){
            return $response;
        }
        return null;
    }

    /* Adjusts the details of a callback object.
     * @param $callback_id {int} The ID of the callback to update.
     * @param $payload {Callback} || {array} || {JSON} The new details for the callback object.
     * @return {Callback} New callback details.
     * @error {ErrorDetail} Details about error happend.
     */
    public function edit($callback_id, $payload){
        if($payload instanceof CallbackModel)
            $payload = $payload->toArray();
        $response = $this->request->put(Url::url_(array("callback", $callback_id)), $payload);
        if($response instanceof ErrorDetail){
            return $response;
        }
        return new CallbackModel($response);
    }
}