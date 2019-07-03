<?php
namespace TrueDialogApi;

require_once 'three_seventy_api/api.php';
require_once 'three_seventy_api/helpers.php';
require_once 'three_seventy_api/model.php';

/* Global variable contains ID of current account. */
$account_id = null;

/* Global config array. */
$T70config = array();

/* Main Client class. */
class Client {
    
    /* Repository objects to avoid double repo initialization. */
    private $account; private $callback; private $campaign; private $channel; private $contact; private $content; private $eventpushcampaign; private $subscription;
    
    /* Initializing Global T70config and Global account_id.
     * @param $config {array} Config array.
     * @return {Client} Main client entity.
     */
    public function __construct($config) {
        global $T70config;
        $T70config = $config;
        $this->setAccount($config['account_id']);
    }
    
    /* Get repository by name.
     * @param $repoName {string} Name of repository to get.
     * @return {object} Repository entity.
     */
    public function getRepo($repoName){
        $repoName = strtolower($repoName);
        if(isset($this->$repoName)){
            return $this->$repoName;
        } else {
            $classname = 'TrueDialogApi\Api\\' . $repoName;
            $this->$repoName = new $classname();
            return $this->$repoName;
        }
    }
    
    /* Get factory by name.
     * @param $factoryName {string} Name of factory to get.
     * @param $presetData {array} || {object} || {JSON} Data to initialize object.
     * @return {object} New object details.
     */
    public function getFactory($factoryName, $presetData = null){
        $factoryName = strtolower($factoryName);
        $classname = 'TrueDialogApi\Model\\' . $factoryName;
        return new $classname($presetData);
    }
    
    /* Sets Global account_id
     * @param $account {int} Account.ID to set as current.
     * @return null;
     */
    public function setAccount($account){
        global $account_id;
        $account_id = $account;
    }
}