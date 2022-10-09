<?php
require 'vendor/autoload.php';

use Twim32\AvitoApi\Client;
use Twim32\AvitoApi\Service\Messenger;
use Twim32\AvitoApi\Service\Tariff;
use Twim32\AvitoApi\Service\User;

$client_id = '';
$client_secret = '';

$token = '';
$expires_in = 86400;
$token_type = 'Bearer';
$user_id = 0;
$chat_id = '';

$auth = new Client($user_id);
$auth->client_id = $client_id;
$auth->client_secret = $client_secret;
// $auth->authenticate($client_id, $client_secret);
$auth->authorize($token, $expires_in, $token_type);
// var_dump($auth);

// $autoload = new Autoload($auth);
// $response = $autoload->items([2142557050]);
// $response = $autoload->getReport(67803800);
// $response = $autoload->getReportItems(67803800);
// $response = $autoload->getReports();


// $msr = new Messenger($auth);
// $response = $msr->getChats($user_id);
// $response = $msr->getChat($user_id, $chat_id);
// $response = $msr->getMessages($user_id, $chat_id);

// $u = new User($auth);
// $response = $u->getUserBalance($user_id);

$t = new Tariff($auth);
$response = $t->getInfo();



var_dump($response);
