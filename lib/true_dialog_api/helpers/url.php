<?php
namespace TrueDialogApi\Helpers;

/* Helper to construct url for request. */
class Url {
    public function url_ ($args = array()){
        global $account_id;
        
        foreach($args as $key => $arg){
            if($key == 0){
                $base_path = "/account/{$account_id}/{$arg}";
            } else {
                $base_path .= "/{$arg}";
            }
        }
        return print_r($base_path, true);
    }
}