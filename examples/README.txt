For better experience enable PHP highlight ;)
<?php
/* Dependencies
 * To access TrueDialog SDK library we must include main file
 */
require '_path_to_lib_folder_/lib/true_dialog_api.php';
/* and config */
require '_path_to_config_/config.php';
/* also we need to specify namespace we use: */
use TrueDialogApi\Client;

/* Working with Client */
/* In order to create Client it must be a config that contents getConfig() function
 * getTDConfig() returns config array:
 */
function getTDConfig(){
    return array(
        "url" => "https://api.truedialog.com/api/v2.1",
        "username" => "<username>",
        "password" => "<password>",
        "account_id" => "<main_account_id>",
    );
}
/* Creating the Client object:
*/
$config = getTDConfig();
$client = new Client($config);
/*
 * And shor variant:
 */
$client = new Client(getTDConfig());

/* Working with Repositories
 * In order to get access to CRUD functions of any entity we need to create
 * repository object
 * E.g.:
 */
$accountRepo = $client->getRepo("Account"); // not case sensitive, so it may be $client->getRepo("account"); or even $client->getRepo("AcCoUnT");
/* In general it's */
$entityRepo = $client->getRepo($entity_name);
/* Since we have Repository object, we can access CRUD functions
 * the most common functions are: get(), getAll(), add(), edit(), delete()
 * E.g.:
 */
$entityList = $entityRepo->getAll(); // for some entities (Account, Campaign, Subscription) there is also boolean inparam (inactive, onlyMine, includeChildren, etc)
$entity = $entityRepo->get($entity_id);
$addResult = $entityRepo->add($entity); // $entity may be associative array or JSON array that represents entity structure or entity object
$editResult = $entityRepo->edit($entity_id, $entity); // $entity may be associative array or JSON array that represents entity structure or entity object
$deleteResult = $entityRepo->delete($entity_id);
/* Also there are CRUD functions for subentities (e.g. ContactAttribute, ContactSubscription, ContentTemplate)
 * accesable via parent entity repository
 * E.g.:
 */
$contentRepo = $client->getRepo("Content");
$attributeList = $contentRepo->getAllAttributes($content_id);
$attribute = $contentRepo->getAttribute($content_id, $attribute_id);
/* Generally it will be: */
$subentityList = $entityRepo->getAll<sub_entity_name>($entity_id);
$subentity = $entityRepo->get/*sub_entity_name_here*/($entity_id, $subentity_id);
$addSubentityResult = $entityRepo->add/*sub_entity_name_here*/($entity_id, $subentity);
$editSubentityResult = $entityRepo->edit/*sub_entity_name_here*/($entity_id, $subentity_id, $subentity);
$deleteSubentityResult = $entityRepo->delete/*sub_entity_name_here*/($entity_id, $subentity_id);
/* Also if you need to fetch object and don't need to use Repository after
 * you can use short variant:
 */
$client->getRepo($entity_name)->getAll();
$client->getRepo($entity_name)->get($entity_id);
$client->getRepo($entity_name)->add($entity);
$client->getRepo($entity_name)->edit($entity);
$client->getRepo($entity_name)->delete($entity);

/* Working with Factories
 * In order to get access to entity models we need to create
 * factory object
 * e.g.:
 */
$accountFactory = $client->getFactory("Account");
/* And get new object: */
$account = $accountFactory->getNew($account_data);
/* Basically, this factory it's just entity model with getNew() function
 * also we can preset params: */
$account = $client->getFactory("Account", $account_data);
/* Generally it will be: */
/* To get factory: */
$entityFactory = $client->getFactory($entity_name);
/* To get factory with preset params: */
$entity = $client->getFactory($entity_name, $entity_data);
/* To get object from the factory: */
$entity = $entityFactory->getNew($entity_data);
/* Also there is short variant; */
$entity = $client->getFactory($entity_name)->getNew($entity_data);
/* All models that have ID, will have getId() method: */
$entity_id = $entity->getId();
/* Also there is _json() method that returns JSON representation of an object */
$entity_json_string = $entity->_json();
/* But native PHP json_encode() can work with objects, 
 * so I think this method will be deprecated */