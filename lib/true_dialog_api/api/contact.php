<?php
namespace TrueDialogApi\Api;

use TrueDialogApi\Helpers\Request;
use TrueDialogApi\Helpers\Url;
use TrueDialogApi\Model\Contact as ContactModel;
use TrueDialogApi\Model\ContactAttribute;
use TrueDialogApi\Model\ContactAttributeCategory;
use TrueDialogApi\Model\ContactAttributeDefinition;
use TrueDialogApi\Model\ContactSubscription;
use TrueDialogApi\Model\ErrorDetail;

/* Repository entity. Allows user to get access to Contact, ContactAttribute, ContactSubscription, ContactAttributeCategory, ContactAttributeDefinition actions.
 * @see contact https://api.truedialog.com/docs/v2.1/RestApi/EndpointList/30
 * @see contact attribute https://api.truedialog.com/docs/v2.1/RestApi/EndpointList/31
 * @see subscription contact https://api.truedialog.com/docs/v2.1/RestApi/EndpointList/57
 * @see contact attribute category https://api.truedialog.com/docs/v2.1/RestApi/EndpointList/32
 * @see contact attribute definition https://api.truedialog.com/docs/v2.1/RestApi/EndpointList/33
 */
class Contact {
    
    /* {Request} Request object to perform calls with. */
    private $request;
    
    public function __construct() {
        $this->request = new Request();
    }
    
    /* Gets a list of contacts for a specific account.
     * @return {array<Contact>} List of contacts for a specific account.
     * @error {ErrorDetail} Details about error happend.
     */
    public function getAll(){
        $response = $this->request->get(Url::url_(array("contact")));
        if($response instanceof ErrorDetail){
            return $response;
        }
        $result = array();
        $contacts = json_decode($response);
        if(is_array($contacts)){
            foreach($contacts as $item){
                $result[] = new ContactModel($item);
            }
        }
        return $result;
    }

    /* Gets the details for a specific contact.
     * @param $contact_id {int} The ID of the contact.
     * @param $validated {bool} Set true to throw error if there is no account with specified id otherwise it returns NULL.
     * @return {Contact} Contact with specified ID.
     * @error {ErrorDetail} Details about error happend.
     */
    public function get($contact_id, $validated = false){
        $response = $this->request->get(Url::url_(array("contact", $contact_id)), $validated);
        if($response instanceof ErrorDetail){
            return $response;
        }
        if(empty($response)){
            return null;
        }
        return new ContactModel($response);
    }

    /* Creates a new contact for the given account.
     * @param $payload {Contact} || {array} || {JSON} Details of the new contact.
     * @return {Contact} New contact details.
     * @error {ErrorDetail} Details about error happend.
     */
    public function add($payload){
        if($payload instanceof ContactModel)
            $payload = $payload->toArray();
        $response = $this->request->post(Url::url_(array("contact")), $payload);
        if($response instanceof ErrorDetail){
            return $response;
        }
        return new ContactModel($response);
    }

    /* Updates a contact with the newly provided information.
     * @param $contact_id {int} The ID of the contact to update.
     * @param $payload {Contact} || {array} || {JSON} The new details of the contact to update.
     * @return {Contact} Updated contact details.
     * @error {ErrorDetail} Details about error happend.
     */
    public function edit($contact_id, $payload){
        if($payload instanceof ContactModel)
            $payload = $payload->toArray();
        $response = $this->request->post(Url::url_(array("contact", $contact_id)), $payload);
        if($response instanceof ErrorDetail){
            return $response;
        }
        return new ContactModel($response);
    }

    /* Does not actually delete the contact, but removes all active subscriptions that contact is participating in.
     * @param @contact_id {int} The ID of the contact to remove.
     * @return NULL.
     * @error {ErrorDetail} Details about error happend.
     */
    public function delete($contact_id){
        $response = $this->request->delete(Url::url_(array("contact", $contact_id)));
        if($response instanceof ErrorDetail){
            return $response;
        }
        return null;
    }
    
    /* Creates a specific attribute item on a contact.
     * @param $contact_id {int} The contact to which the property belongs.
     * @param $attribute {ContactAttribute} || {array} || {JSON} The new details of the ContactAttribute.
     * @return {ContactAttribute} New ContactAttribute details.
     * @error {ErrorDetail} Details about error happend.
     */
    public function addAttribute($contact_id, $attribute){
        if($attribute instanceof ContactAttribute)
            $attribute = $attribute->toArray ();
        if(is_string($attribute))
            $attribute = json_decode($attribute);
        $attribute_name = isset($attribute['Name']) ? $attribute['Name'] : null;
        $attribute_value = isset($attribute['Value']) ? $attribute['Value'] : null;
        $response = $this->request->post(Url::url_(array("contact", $contact_id, "attribute", $attribute_name)), $attribute_value);
        if($response instanceof ErrorDetail){
            return $response;
        }
        return new ContactAttribute($response);
    }
    
    /* Updates a specific attribute item on a contact.
     * @param $contact_id {int} The contact to which the property belongs.
     * @param $attribute_name {string} The name (or attribute defintion ID) of the attribute to update.
     * @param $attribute_value {string} The new value for the attribute.
     * @return {ContactAttribute} Updated ContactAttribute details.
     * @error {ErrorDetail} Details about error happend.
     */
    public function editAttribute($contact_id, $attribute_name, $attribute_value){
        $response = $this->request->put(Url::url_(array("contact", $contact_id, "attribute", $attribute_name)), $attribute_value);
        if($response instanceof ErrorDetail){
            return $response;
        }
        return new ContactAttribute($response);
    }
    
    /* Gets the value for a specific attribute.
     * @param $contact_id {int} The contact to which the property belongs.
     * @param $attribute_name {string} The name (or attribute defintion ID) of the attribute to get.
     * @param $validated {bool} Set true to throw error if there is no account with specified id otherwise it returns NULL.
     * @return {ContactAttribute} ContactAttribute with specified ID.
     * @error {ErrorDetail} Details about error happend.
     */
    public function getAttribute($contact_id, $attribute_name, $validated = false){
        $response = $this->request->get(Url::url_(array("contact", $contact_id, "attribute", $attribute_name)), $validated);
        if($response instanceof ErrorDetail){
            return $response;
        }
        return new ContactAttribute($response);
    }
    
    /* Lists all attributes on a contact as a set of name value pairs.
     * @param $contact_id {int} The contact to which the attributes belong.
     * @return {array<ContactAttribute>} List of attributes on a contact.
     * @error {ErrorDetail} Details about error happend.
     */
    public function getAllAttributes($contact_id){
        $response = $this->request->get(Url::url_(array("contact", $contact_id, "attribute")));
        if($response instanceof ErrorDetail){
            return $response;
        }
        $result = array();
        $attributes = json_decode($response);
        if(is_array($attributes)){
            foreach($attributes as $item){
                $result[] = new ContactAttribute($item);
            }
        }
        return $result;
    }
    
    /* Removes a specific attribute data item.
     * @param $contact_id {int} The contact to which the property belongs.
     * @param $attribute_name {string} The name (or attribute defintion ID) of the attribute to remove.
     * @return NULL.
     * @error {ErrorDetail} Details about error happend.
     */
    public function deleteAttribute($contact_id, $attribute_name){
        $response = $this->request->delete(Url::url_(array("contact", $contact_id, "attribute", $attribute_name)));
        if($response instanceof ErrorDetail){
            return $response;
        }
        return null;
    }
    
    /* Opts a contact into the subscription. Contacts are sent a handset verificaton message.
     * @param $subscription_id {int} The subscription ID which the contact is to be opted into.
     * @param $payload {ContactSubscription} || {array} || {JSON} Opt in details.
     * @return {ContactSubscription} New ContactSubscription details.
     * @error {ErrorDetail} Details about error happend.
     */
    public function addSubscription($subscription_id, $payload){
        if($payload instanceof ContactSubscription)
            $payload = $payload->toArray();
        $response = $this->request->post(Url::url_(array("subscription", $subscription_id, "contact")), $payload);
        if($response instanceof ErrorDetail){
            return $response;
        }
        return new ContactSubscription($response);
    }
    
    /* Updates a contact's subscription recept options. Note that if no options are set, then the subscription is removed. Contacts are sent a handset verificaton message.
     * @param $subscription_id {int} The ID of the subscription the contact is in.
     * @param $contact_id {int} The contact who's subscription preferences are to be changed.
     * @param $payload {ContactSubscription} || {array} || {JSON} Details for the subscription options.
     * @return {ContactSubscription} Updated ContactSubscription details.
     * @error {ErrorDetail} Details about error happend.
     */
    public function editSubscription($subscription_id, $contact_id, $payload){
        if($payload instanceof ContactSubscription)
            $payload = $payload->toArray();
        $response = $this->request->put(Url::url_(array("subscription", $subscription_id, "contact", $contact_id)), $payload);
        if($response instanceof ErrorDetail){
            return $response;
        }
        return new ContactSubscription($response);
    }
    
    /* Returns opt in information if the contact is opted in. Ohterwise returns a No Content message if the contact is not currently opted in.
     * @param $subscription_id {int} The subscription ID which the contact has a history with.
     * @param $contact_id {int} The ID of the contact who's history is to be checked.
     * @param $validated {bool} Set true to throw error if there is no account with specified id otherwise it returns NULL.
     * @return {ContactSubscription} ContactSubscription with specified ID.
     * @error {ErrorDetail} Details about error happend.
     */
    public function getSubscription($subscription_id, $contact_id, $validated = false){
        $response = $this->request->get(Url::url_(array("subscription", $subscription_id, "contact", $contact_id)), $validated);
        if($response instanceof ErrorDetail){
            return $response;
        }
        return new ContactSubscription($response);
    }
    
    /* Gets a list of contacts that have opted into the subscription.
     * @param $subscription_id {int} The subscription to get the contact list from.
     * @return {array<ContactSubscription>} List of contact have opted into the subscription.
     * @error {ErrorDetail} Details about error happend.
     */
    public function getAllSubscriptions($subscription_id){
        $response = $this->request->get(Url::url_(array("subscription", $subscription_id, "contact")));
        if($response instanceof ErrorDetail){
            return $response;
        }
        $result = array();
        $subscriptions = json_decode($response);
        if(is_array($subscriptions)){
            foreach($subscriptions as $item){
                $result[] = new ContactSubscription($item);
            }
        }
        return $result;
    }
    
    /* Opts a contact out of the subscription.
     * @param $subscription_id {int} The ID of the subscription to opt out of.
     * @param $contact_id {int} The contact to remove from the subscription.
     * @return NULL.
     * @error {ErrorDetail} Details about error happend.
     */
    public function deleteSubscription($subscription_id, $contact_id){
        $response = $this->request->delete(Url::url_(array("subscription", $subscription_id, "contact", $contact_id)));
        if($response instanceof ErrorDetail){
            return $response;
        }
        return null;
    }
    
    /* Lists all categories for contact attributes.
     * @return {array<ContactAttributeCategory>} List of categories for contact attributes.
     * @error {ErrorDetail} Details about error happend.
     */
    public function getAllAttributeCategories(){
        $response = $this->request->get("/reference/contact-attribute-category");
        if($response instanceof ErrorDetail){
            return $response;
        }
        $result = array();
        $attributes = json_decode($response);
        if(is_array($attributes)){
            foreach($attributes as $item){
                $result[] = new ContactAttributeCategory($item);
            }
        }
        return $result;
    }
    
    /* Gets the details for a specific contact attribute category.
     * @param $category_id {int} The ID of the category to get.
     * @return {ContactAttributeCategory} Contact attribute category with specified ID.
     * @error {ErrorDetail} Details about error happend.
     */
    public function getAttributeCategory($category_id){
        $response = $this->request->get("/reference/contact-attribute-category/" . $category_id);
        if($response instanceof ErrorDetail){
            return $response;
        }
        return new ContactAttributeCategory($response);
    }
    
    /* Lists all of the attribute definitions that are available to the supplied account ID.
     * @return {array<ContactAttributeDefinition>} List of contact attribute definitions.
     * @error {ErrorDetail} Details about error happend.
     */
    public function getAllAttributeDefinitions(){
        $response = $this->request->get(Url::url_(array("contact-attributeDef")));
        if($response instanceof ErrorDetail){
            return $response;
        }
        $result = array();
        $attributeDefs = json_decode($response);
        if(is_array($attributeDefs)){
            foreach($attributeDefs as $item){
                $result[] = new ContactAttributeDefinition($item);
            }
        }
        return $result;
    }
    
    /* Gets the details for a specific attribute definition.
     * @param $attribDefId {int} The ID of the specific attribute definition to get.
     * @param $validated {bool} Set true to throw error if there is no account with specified id otherwise it returns NULL.
     * @return {ContactAttributeDefinition} Contact attribute definition with specified ID.
     * @error {ErrorDetail} Details about error happend.
     */
    public function getAttributeDefinition($attribDefId, $validated = false){
        $response = $this->request->get(Url::url_(array("contact-attributeDef", $attribDefId)), $validated);
        if($response instanceof ErrorDetail){
            return $response;
        }
        return new ContactAttributeDefinition($response);
    }
    
    /* Creates a new attribute definition.
     * @param $payload {ContactAttributeDefinition} || {array} || {JSON} Details of the new attribute definition.
     * @return {ContactAttributeDefinition} New attribute definition details.
     * @error {ErrorDetail} Details about error happend.
     */
    public function addAttributeDefinition($payload){
        if($payload instanceof ContactAttributeDefinition)
            $payload = $payload->toArray();
        $response = $this->request->post(Url::url_(array("contact-attributeDef")), $payload);
        if($response instanceof ErrorDetail){
            return $response;
        }
        return new ContactAttributeDefinition($response);
    }
    
    /* Update an account attribute definition.
     * @param $attribDefId {int} The ID of the specific attribute definition to update
     * @param $payload {ContactAttributeDefinition} The details of the new attribute definition.
     * @return {ContactAttributeDefinition} Updated attribute definition details.
     * @error {ErrorDetail} Details about error happend.
     */
    public function editAttributeDefinition($attribDefId, $payload){
        if($payload instanceof ContactAttributeDefinition)
            $payload = $payload->toArray();
        $response = $this->request->put(Url::url_(array("contact-attributeDef", $attribDefId)), $payload);
        if($response instanceof ErrorDetail){
            return $response;
        }
        return new ContactAttributeDefinition($response);
    }
    
    /* Removes the supplied attribute defition and any associated attribute values. 
     * Note that only the account which initially created the attribute definition is allowed to delete it.
     * @param $attribDefId {int} The ID of the specific attribute definition to remove.
     * @return NULL.
     * @error {ErrorDetail} Details about error happend.
     */
    public function deleteAttributeDefinition($attribDefId){
        $response = $this->request->delete(Url::url(array("contact-attributeDef", $attribDefId)));
        if($response instanceof ErrorDetail){
            return $response;
        }
        return null;
    }
}