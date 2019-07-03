<?php
namespace TrueDialogApi\Api;

use TrueDialogApi\Helpers\Request;
use TrueDialogApi\Helpers\Url;
use TrueDialogApi\Model\ActionPushCampaign as ActionPushCampaignModel;
use TrueDialogApi\Model\ErrorDetail;

/* Repository entity. Allows user to get access to ActionPushCampaign actions.
 * @see https://api.truedialog.com/docs/v2.1/RestApi/EndpointList/10
 */
class ActionPushCampaign {

    /* {Request} Request object to perform calls with. */
    private $request;

    public function __construct() {
        $this->request = new Request();
    }
    
    /* Gets the details for a specific push campaign event.
     * @param $event_id {int} The specific event to get.
     * @param $validated {bool} Set true to throw error if there is no account with specified id otherwise it returns NULL.
     * @return {ActionPushCampaign} Push campaign event with specified ID.
     * @error {ErrorDetail} Details about error happend.
     */
    public function get($event_id, $validated = false){
        $response = $this->request->get(Url::url_(array("action-pushcampaign", $event_id)), $validated);
        if($response instanceof ErrorDetail){
            return $response;
        }
        if(empty($response)){
            return null;
        }
        return new ActionPushCampaignModel($response);
    }

    /* Pushes a campaign to a list of phone numbers.
     * @param $payload {EventPushCampaign} || {array} || {JSON} Details of the event to run.
     * @return {EventPushCampaign} New push campaign event details.
     * @error {ErrorDetail} Details about error happend.
     */
    public function add($payload){
        if($payload instanceof ActionPushCampaignModel)
            $payload = $payload->toArray();
        $response = $this->request->post(Url::url_(array("action-pushcampaign")), $payload);
        if($response instanceof ErrorDetail){
            return $response;
        }
        return new ActionPushCampaignModel($response);
    }

    /* Gets the details for all push campaign events.
     * @return {array<EventPushCampaign>} List of pushed campaign events.
     * @error {ErrorDetail} Details about error happend.
     */
    public function getAll(){
        $response = $this->request->get(Url::url_(array("action-pushcampaign")));
        if($response instanceof ErrorDetail){
            return $response;
        }
        $result = array();
        $pushes = json_decode($response);
        if(is_array($pushes)){
            foreach($pushes as $item){
                $result[] = new ActionPushCampaignModel($item);
            }
        }
        return $result;
    }
}