<?php
namespace TrueDialogApi\Api;

use TrueDialogApi\Helpers\Request;
use TrueDialogApi\Helpers\Url;
use TrueDialogApi\Model\Account as AccountModel;
use TrueDialogApi\Model\AccountAttribute;
use TrueDialogApi\Model\ErrorDetail;

/* Repository entity. Allows user to get access to Account and AccountAttribute actions.
 * @see https://api.truedialog.com/docs/v2.1/RestApi/EndpointList/1
 * @see https://api.truedialog.com/docs/v2.1/RestApi/EndpointList/2
 */
class Account {
    
    /* {Request} Request object to perform calls with. */
    private $request;
    
    public function __construct() {
        $this->request = new Request();
    }
    
    
    /* Returns a list of accounts that exist for the user currently logged in.
     * @param $inactive {bool} Set to true to get all accounts, active and inactive. 
     * @return {array<Account>} List of accounts.
     * @error {ErrorDetail} Details about error happend.
     */
    public function getAll($inactive = false){
        $inactive = $inactive ? 'true' : 'false';
        $end_point = "/account?inactive=" . $inactive;
        $response = $this->request->get($end_point);
        if($response instanceof ErrorDetail){
            return $response;
        }
        $result = array();
        $accounts = json_decode($response);
        if(is_array($accounts)){
            foreach($accounts as $item){
                $result[] = new AccountModel($item);
            }
        }
        return $result;
    }
    
    /* Gets detailed information about a specific account.
     * @param $account_id {int} The ID of the account to retrieve.
     * @param $validated {bool} Set true to throw error if there is no account with specified id otherwise it returns NULL.
     * @return {Account} Account with specified ID.
     * @error {ErrorDetail} Details about error happend.
     */
    public function get($account_id, $validated = false){
        $response = $this->request->get("/account/" . $account_id, $validated);
        if($response instanceof ErrorDetail)
            return $response;
        if(empty($response)){
            return null;
        }
        return new AccountModel($response);
    }
    
    /* Creates a new account in the system with the specified details.
     * @param $payload {array} || {Account} || {JSON} Details of the account to add.
     * @return {Account} New Account details.
     * @error {ErrorDetail} Details about error happend.
     */
    public function add($payload){
        if($payload instanceof AccountModel)
            $payload = $payload->toArray();
        $response = $this->request->post("/account", $payload);
        if($response instanceof ErrorDetail){
            return $response;
        }
        return new AccountModel($response);
    }
    
    /* Removes a given account from the system. Note that this does not actually remove the account record, but rather changes its status to inactive.
     * @param $account_id {int} ID of account to disable.
     * @return NULL.
     * @error {ErrorDetail} Details about error happend.
     */
    public function delete($account_id){
        $response = $this->request->delete("/account/" . $account_id);
        if($response instanceof ErrorDetail){
            return $response;
        }
        return null;
    }

    /* Updates an account with a new set of information.
     * @param $account_id {int} ID of the account to modify.
     * @param $payload {array} || {Account} || {JSON} The new details for the account.
     * @return {Account} New account details.
     * @error {ErrorDetail} Details about error happend.
     */
    public function edit($account_id, $payload){
        if($payload instanceof AccountModel)
            $payload = $payload->toArray();
        $response = $this->request->put("/account/" . $account_id, $payload);
        if($response instanceof ErrorDetail){
            return $response;
        }
        return new AccountModel($response);
    }
    
    /* Gets all values set on an account. Note that inherited values are also returned. The ID of the account which the value is directly set is returned for reference.
     * @param $account_id {int} The account to check.
     * @return {array<Account>} Account attributes list.
     * @error {ErrorDetail} Details about error happend.
     */    
    public function getAllAttributes($account_id = null){
        if(isset($account_id)){
            $response = $this->request->get("/account/" . $account_id . "/attribute");
        } else {
            $response = $this->request->get(Url::url_(array("attribute")));
        }
        if($response instanceof ErrorDetail){
            return $response;
        }
        $result = array();
        $attributes = json_decode($response);
        if(is_array($attributes)){
            foreach($attributes as $item){
                $result[] = new AccountAttribute($item);
            }
        }
        return $result;
    }
    
    /* Gets a value that is set on an account.
     * @param $attribute_name {string} The name or ID of the value to view.
     * @param $account_id Nullable{int} The account to check. If null - returns attributes of current account.
     * @return {AccountAttribute} Account attribute with specified ID.
     * @error {ErrorDetail} Details about error happend.
     */
    public function getAttribute($attribute_name, $account_id = null, $validated = false){
        if(isset($account_id)){
            $response = $this->request->get("/account/" . $account_id . "/attribute/" . $attribute_name, $validated);
        } else {
            $response = $this->request->get(Url::url_(array("attribute", $attribute_name)));
        }
        if($response instanceof ErrorDetail)
            return $response;
        if(empty($response)){
            return null;
        }
        return new AccountAttribute($response);
    }
    
    /* Sets an attribute on an account.
     * @param $payload {array} || {AccountAttribute} || {JSON} The name or ID of the value to set and the value to set.
     * @param $account_id Nullable{int} The account to modify. If null - creates attribute on current account.
     * @return {AccountAttribute} New account attributes details.
     * @error {ErrorDetail} Details about error happend.
     */
    public function addAttribute($payload, $account_id = null){
        if($payload instanceof AccountAttribute)
            $payload = $payload->toArray();
        if(is_string($payload))
            $payload = json_decode($payload);
        $attribute = (array) $payload;
        $attribute_name = isset($attribute['Name']) ? $attribute['Name'] : null;
        $attribute_value = isset($attribute['Value']) ? $attribute['Value'] : null;
        
        if(isset($account_id)){
            $response = $this->request->post("/account/" . $account_id . "/attribute/" . $attribute_name, $attribute_value);
        } else {
            $response = $this->request->post(Url::url_(array("attribute". $attribute_name)), $attribute_value);
        }
        if($response instanceof ErrorDetail){
            return $response;
        }
        return new AccountAttribute($response);
    }
    
    /* Changes or sets a value on an account.
     * @param $payload {array} || {AccountAttribute} || {JSON} The name or ID of the value to set and the value to set.
     * @param $account_id Nullable{int} The account to modify. If null - modifies attributes of current account.
     * @return {AccountAttribute} New account attribute details.
     * @error {ErrorDetail} Details about error happend.
     */
    public function editAttribute($payload, $account_id = null){
        if($payload instanceof AccountAttribute)
            $payload = $payload->toArray();
        if(is_string($payload))
            $payload = json_decode($payload);
        $attribute = (array) $attribute;
        $attribute_name = isset($attribute['Name']) ? $attribute['Name'] : null;
        $attribute_value = isset($attribute['Value']) ? $attribute['Value'] : null;
        
        if(isset($account_id)){
            $response = $this->request->put("/account/" . $account_id . "/attribute/" . $attribute_name, $attribute_value);
        } else {
            $response = $this->request->put(Url::url_(array("attribute", $attribute_name)), $attribute_value);
        }
        if($response instanceof ErrorDetail){
            return $response;
        }
        return new AccountAttribute($response);
    }
    
    /* Removes an account attribute value from an account. Note that this will only remove the attribute that is immediately set on an account. 
     * Inhertied values must be unset on their respective parent account id.
     * @param $attribute_name {string} The name or ID of the value to remove.
     * @param $account_id Nullable{int} The account from which the value should be removed.. If null - deletes attributes from current account.
     * @return NULL.
     * @error {ErrorDetail} Details about error happend.
     */
    public function deleteAttribute($attribute_name, $account_id = null){
        if(isset($account_id)){
            $response = $this->request->delete("/attribute/" . $account_id . "/attribute/" . $attribute_name);
        } else {
            $response = $this->request->delete(Url::url_(array("attribute", $attribute_name)));
        }
        if($response instanceof ErrorDetail){
            return $response;
        }
        return null;
    }    
}