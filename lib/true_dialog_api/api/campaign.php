<?php
namespace TrueDialogApi\Api;

use TrueDialogApi\Helpers\Request;
use TrueDialogApi\Helpers\Url;
use TrueDialogApi\Model\Campaign as CampaignModel;
use TrueDialogApi\Model\ErrorDetail;

/* Repository entity. Allows user to get access to Campaign actions.
 * @see https://api.truedialog.com/docs/v2.1/RestApi/EndpointList/18
 */
class Campaign {

    /* {Request} Request object to perform calls with. */
    private $request;
    
    public function __construct() {
        $this->request = new Request();
    }
    
    /* Gets a list of all campaigns belonging to an account.
     * @param $visibility {bool} Unset to display all items.
     * @return {array<Campaign>} List of campaigns belonging to an account.
     * @error {ErrorDetail} Details about error happend.
     */
    public function getAll($visibility = true){
        $visibility = $visibility ? 'true' : 'false';
        $end_point = Url::url_(array("campaign")) . "?onlyMine=" . $visibility;
        $response = $this->request->get($end_point);
        if($response instanceof ErrorDetail){
            return $response;
        }
        $result = array();
        $campaigns = json_decode($response);
        if(is_array($campaigns)){
            foreach($campaigns as $campaign){
                $result[] = new CampaignModel($campaign);
            }
        }
        return $result;
    }

    /* Retreave the details for a specific campaign.
     * @param $campaign_id {int} The specific campaign to retrieve.
     * @param $validated {bool} Set true to throw error if there is no account with specified id otherwise it returns NULL.
     * @return {Campaign} Campaign with specified ID.
     * @error {ErrorDetail} Details about error happend.
     */
    public function get($campaign_id, $validated = false){
        $response = $this->request->get(Url::url_(array("campaign", $campaign_id)), $validated);
        if($response instanceof ErrorDetail){
            return $response;
        }
        if(empty($response)){
            return null;
        }
        return new CampaignModel($response);
    }

    /* Creates a new campaign with the given details for the supplied account ID.
     * @param @payload {Campaing} || {array} || {JSON} Details of the new campaign.
     * @return {Campaign} New campaign details.
     * @error {ErrorDetail} Details about error happend.
     */
    public function add($payload){
        if($payload instanceof CampaignModel)
            $payload = $payload->toArray();
        $response = $this->request->post(Url::url_(array("campaign")), $payload);
        if($response instanceof ErrorDetail){
            return $response;
        }
        return new CampaignModel($response);
    }

    /* Removes a campaign from the system.
     * @param $campaign_id {int} The ID of the campaign to remove.
     * @return NULL.
     * @error {ErrorDetail} Details about error happend.
     */
    public function delete($campaign_id){
        $response = $this->request->delete(Url::url_(array("campaign", $campaign_id)));
        if($response instanceof ErrorDetail){
            return $response;
        }
        return null;
    }

    /* Update a campaign with new details.
     * @param $campaign_id {int} The ID of the campaign to update
     * @param $payload {Campaign} || {array} || {JSON} The new details for the campaign
     * @return {Campaign} Updated campaign details.
     * @error {ErrorDetail} Details about error happend.
     */
    public function edit($campaign_id, $payload){
        if($payload instanceof CampaignModel)
            $payload = $payload->toArray();
        $response = $this->request->put(Url::url_(array("campaign", $campaign_id)), $payload);
        if($response instanceof ErrorDetail){
            return $response;
        }
        return new CampaignModel($response);
    }
}