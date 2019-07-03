<?php
namespace TrueDialogApi\Api;

use TrueDialogApi\Helpers\Request;
use TrueDialogApi\Helpers\Url;
use TrueDialogApi\Model\Channel as ChannelModel;
use TrueDialogApi\Model\ErrorDetail;

/* Repository entity. Allows user to get access to Channel actions.
 * @see https://api.truedialog.com/docs/v2.1/RestApi/EndpointList/26
 */
class Channel {
    
    /* {Request} Request object to perform calls with. */
    private $request;
    
    public function __construct() {
        $this->request = new Request();
    }
    
    /* Returns a list of channels that fall under a given account.
     * @return {array<Channel>} List of channels that fall under a given account.
     * @error {ErrorDetail} Details about error happend.
     */
    public function getAll(){
        $response = $this->request->get(Url::url_(array("channel")));
        if($response instanceof ErrorDetail){
            return $response;
        }
        $result = array();
        $channels = json_decode($response);
        if(is_array($channels)){
            foreach($channels as $item){
                $result[] = new ChannelModel($item);
            }
        }
        return $result;
    }

    /* Gets details of a specific channel.
     * @param $channel_id {int} The ID of the channel to get the details of.
     * @param $validated {bool} Set true to throw error if there is no account with specified id otherwise it returns NULL.
     * @return {Channel} Channel with specified ID.
     * @error {ErrorDetail} Details about error happend.
     */
    public function get($channel_id, $validated = false){
        $response = $this->request->get(Url::url_(array("channel", $channel_id)), $validated);
        if($response instanceof ErrorDetail){
            return $response;
        }
        if(empty($response)){
            return null;
        }
        return new ChannelModel($response);
    }
}