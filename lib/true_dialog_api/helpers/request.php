<?php
namespace TrueDialogApi\Helpers;
use TrueDialogApi\Client;
require_once 'rest_client.php';

/* Request class. */
class Request {
    
    /* REST HTTP client */
    private $client;

    public function __construct(){
        if(!isset($this->client)){
            global $TDconfig;
            if(!empty($TDconfig)){
                $config = $TDconfig;
            } else {
                $config = \getTDConfig();
            }
            $this->client = new \RestClient($config['url'], $config['username'], $config['password']);
        }
    }
    
    /* Used to make a GET request.
     * @param $path {string} URL of the request.
     * @param $validated {bool} Set true to throw error if there is no account with specified id otherwise it returns NULL.
     * @return {Object} Response object or null if not found.
     * @error {ErrorDetails} Prints error details and terminates request proccess.
     */
    public function get($path, $validated = false){
        try {
            return $this->client->get($path, $validated);
        } catch(\Exception $e){
            print $e->getMessage();
            die;
        }
    }

    /* Used to make a PUT request.
     * @param $path {string} URL of the request.
     * @param $payload {object} || {array} || {JSON} Submission of the request.
     * @return {Object} Response object.
     * @error {ErrorDetails} Prints error details and terminates request proccess.
     */
    public function put($path, $payload){
        try {
            return $this->client->put($path, $payload);
        } catch(\Exception $e){
            print $e->getMessage();
            die;
        }
    }

    /* Used to make a POST request.
     * @param $path {string} URL of the request.
     * @param $payload {object} || {array} || {JSON} Submission of the request.
     * @return {Object} Response object.
     * @error {ErrorDetails} Prints error details and terminates request proccess.
     */
    public function post($path, $payload){
        try{
            return $this->client->post($path, $payload);
        } catch(\Exception $e){
            print $e->getMessage();
            die;
        }
    }

    /* Used to make a DELETE request.
     * @param $path {string} URL of the request.
     * @return {Object} NULL.
     * @error {ErrorDetails} Prints error details and terminates request proccess.
     */
    public function delete($path){
        try{
            return $this->client->delete($path);
        } catch(\Exception $e){
            print $e->getMessage();
            die;
        }
    }
}