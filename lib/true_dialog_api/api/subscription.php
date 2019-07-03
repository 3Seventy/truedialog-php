<?php

namespace TrueDialogApi\Api;

use TrueDialogApi\Helpers\Request;
use TrueDialogApi\Helpers\Url;
use TrueDialogApi\Model\Subscription as SubscriptionModel;
use TrueDialogApi\Model\ErrorDetail;

/* Repository entity. Allows user to get access to Subscription actions.
 * @see 
 */
class Subscription{
    
    /* {Request} Request object to perform calls with. */
    private $request;

    public function __construct() {
        $this->request = new Request();
    }
    
    /* Creates a new subscription object.
     * @param $payload {Subscription} || {array} || {JSON} The new subscriptions details.
     * @return {Subscription} New subscription details.
     * @error {ErrorDetail} Details about error happend.
     */
    public function add($payload){
        if($payload instanceof SubscriptionModel)
            $payload = $payload->toArray();
        $response = $this->request->post(Url::url_(array("subscription")), $payload);
        if($response instanceof ErrorDetail){
            return $response;
        }
        return new SubscriptionModel($response);
    }

    /* Returns the details for a specific subscription object.
     * @param $subscription_id {int} The ID of the subscription to return.
     * @param $validated {bool} Set true to throw error if there is no account with specified id otherwise it returns NULL.
     * @return {Subscription} Subscription with specified ID.
     * @error {ErrorDetail} Details about error happend.
     */
    public function get($subscription_id, $validated){
        $response = $this->request->get(Url::url_(array("subscription", $subscription_id)), $validated);
        if($response instanceof ErrorDetail){
            return $response;
        }
        if(empty($response)){
            return null;
        }
        return new SubscriptionModel($response);
    }

    /* Adjusts the details of a subscription object.
     * @param $subscription_id {int} The ID of the subscription to update.
     * @param $payload {Subscription} || {array} || {JSON} The new details for the subscription object.
     * @return {Subscription} Updated subscription details.
     * @error {ErrorDetail} Details about error happend.
     */
    public function edit($subscription_id, $payload){
        if($payload instanceof SubscriptionModel)
            $payload = $payload->toArray();
        $response = $this->request->put(Url::url_(array("subscription", $subscription_id)), $payload);
        if($response instanceof ErrorDetail){
            return $response;
        }
        return new SubscriptionModel($response);
    }

    /* Removes a subscription object.
     * @param $subscription_id {int} The ID of the subscription object to remove.
     * @return NULL.
     * @error {ErrorDetail} Details about error happend.
     */
    public function delete($subscription_id){
        $response = $this->request->delete(Url::url_(array("subscription", $subscription_id)));
        if($response instanceof ErrorDetail){
            return $response;
        }
        return null;
    }

    /* Gets a list of all subscriptions for an account.
     * @param $includeChildren {bool} Checking this flag will return the results that include child accounts
     * @return {array<Subscription>} List of all subscriptions for an account.
     * @error {ErrorDetail} Details about error happend.
     */ 
    public function getAll($includeChildren = false){
        $includeChildren = $includeChildren ? 'true' : 'false';
        $response = $this->request->get(Url::url_(array("subscription")) . "?includeChildren=" . $includeChildren);
        if($response instanceof ErrorDetail){
            return $response;
        }
        $result = array();
        $subscriptions = json_decode($response);
        if(is_array($subscriptions)){
            foreach($subscriptions as $item){
                $result[] = new SubscriptionModel($item);
            }
        }
        return $result;
    }
}