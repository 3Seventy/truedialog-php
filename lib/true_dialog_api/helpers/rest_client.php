<?php

use TrueDialogApi\Model\ErrorDetail;

/* REST HTTP client. */
class RestClient {
    
    /* Base request url. */
    private $url;
    /* Username for HTTP auth. */
    private $username;
    /* Password for HTTP auth. */
    private $password;
    
    public function __construct($url, $username = null, $password = null) {
        $this->url = $url;
        $this->username = $username;
        $this->password = $password;
    }
    
    /* Performs get request.
     * @param $path {string} URL of the request.
     * @param $validated {bool} Set true to throw error if there is no account with specified id otherwise it returns NULL.
     * @param $accept {string} Accept header, used to configure server response type.
     * @return Response via getResponse() see below.
     * @error Throws exception if curl_error occured.
     */
    public function get($path = null, $validate = false, $accept = "application/json"){
        $curl = curl_init();
        $headers = array(
            "Accept: " . $accept,
        );
        curl_setopt($curl, CURLOPT_URL, $this->url . $path);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, $this->username . ':' . $this->password);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        
        $response = curl_exec($curl);
       
        if($response === FALSE){
            throw new \Exception(curl_error($curl));
        }
        $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $curl_info = curl_getinfo($curl);
        $http_response = $curl_info['http_code'];
        $body = substr($response, $header_size);
        curl_close($curl);
        return $this->getResponse($http_response, $body, $validate);
    }
    
    /* Performs put request.
     * @param $path {string} URL of the request.
     * @param $data {object} || {array} || {JSON} Submission data.
     * @param $accept {string} Accept header, used to configure server response type.
     * @param $content_type {string} Content type of submission.
     * @return Response via getResponse() see below.
     * @error Throws exception if curl_error occured.
     */
    public function put($path = null, $data = null, $accept = "application/json", $content_type = "application/json"){
        if(!is_string($data)){
            $data = json_encode($data);
        }
        $curl = curl_init();
        $headers = array(
            "Accept: " . $accept,
            "Content-Type: " . $content_type,
        );
        curl_setopt($curl, CURLOPT_URL, $this->url . $path);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, $this->username . ':' . $this->password);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
        
        $response = curl_exec($curl);
        
        if($response === FALSE){
            throw new Exception(curl_error($curl));
        }
        $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $curl_info = curl_getinfo($curl);
        $http_response = $curl_info['http_code'];
        $body = substr($response, $header_size);
        curl_close($curl);
        return $this->getResponse($http_response, $body);
    }
    
    /* Performs post request.
     * @param $path {string} URL of the request.
     * @param $data {object} || {array} || {JSON} Submission data.
     * @param $accept {string} Accept header, used to configure server response type.
     * @param $content_type {string} Content type of submission.
     * @return Response via getResponse() see below.
     * @error Throws exception if curl_error occured.
     */
    public function post($path = null, $data = null, $accept = "application/json", $content_type = "application/json"){
        if(!is_string($data)){
            $data = json_encode($data);
        }
        $curl = curl_init();
        $headers = array(
            "Accept: " . $accept,
            "Content-Type: " . $content_type,
        );
        curl_setopt($curl, CURLOPT_URL, $this->url . $path);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, $this->username . ':' . $this->password);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        
        $response = curl_exec($curl);
        
        if($response === FALSE){
            throw new Exception(curl_error($curl));
        }
        $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $curl_info = curl_getinfo($curl);
        $http_response = $curl_info['http_code'];
        $body = substr($response, $header_size);
        curl_close($curl);
        return $this->getResponse($http_response, $body);
    }
    
    /* Performs delete request.
     * @param $path {string} URL of the request.
     * @param $accept {string} Accept header, used to configure server response type.
     * @return Response via getResponse() see below.
     * @error Throws exception if curl_error occured.
     */
    public function delete($path = null, $accept = "application/json"){
        $curl = curl_init();
        $headers = array(
            "Accept: " . $accept,
        );
        curl_setopt($curl, CURLOPT_URL, $this->url . $path);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, $this->username . ':' . $this->password);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
        
        $response = curl_exec($curl);
        
        if($response === FALSE){
            throw new Exception(curl_error($curl));
        }
        $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $curl_info = curl_getinfo($curl);
        $http_response = $curl_info['http_code'];
        $body = substr($response, $header_size);
        curl_close($curl);
        return $this->getResponse($http_response, $body);
    }
    
    /* Used to return response.
     * @param $http_response {int} HTTP response code, you can see codes below.
     * @param $body {mixed} Response body.
     * @param $validated {bool} Set true to throw error if there is no account with specified id otherwise it returns NULL.
     * @return {object} Returns response body if request is success.
     * @error {ErrorDetails} Returns error details of throws exception if validated and not found.
     */
    private function getResponse($http_response = null, $body = null, $validate = false){
        if(isset($http_response)){
            if($http_response == 404 || $http_response == 204){
                if($validate){
                    throw new \Exception("Not Found");
                }
                return null;
            }
            if($http_response >= 300){
                $body = json_decode($body);
                if(is_array($body)){
                    foreach($body as $error){
                        $response = new ErrorDetail($error);
                    }
                } else {
                    $response = new ErrorDetail();
                    $response->error_code_id = $http_response;
                    $response->error_message = $body;
                }
                return $response;
            } else {
                return $body;
            }
        } else {
            return $body;
        }
    }
}
/*[Informational 1xx]
100="Continue"
101="Switching Protocols"

[Successful 2xx]
200="OK"
201="Created"
202="Accepted"
203="Non-Authoritative Information"
204="No Content"
205="Reset Content"
206="Partial Content"

[Redirection 3xx]
300="Multiple Choices"
301="Moved Permanently"
302="Found"
303="See Other"
304="Not Modified"
305="Use Proxy"
306="(Unused)"
307="Temporary Redirect"

[Client Error 4xx]
400="Bad Request"
401="Unauthorized"
402="Payment Required"
403="Forbidden"
404="Not Found"
405="Method Not Allowed"
406="Not Acceptable"
407="Proxy Authentication Required"
408="Request Timeout"
409="Conflict"
410="Gone"
411="Length Required"
412="Precondition Failed"
413="Request Entity Too Large"
414="Request-URI Too Long"
415="Unsupported Media Type"
416="Requested Range Not Satisfiable"
417="Expectation Failed"

[Server Error 5xx]
500="Internal Server Error"
501="Not Implemented"
502="Bad Gateway"
503="Service Unavailable"
504="Gateway Timeout"
505="HTTP Version Not Supported"*/