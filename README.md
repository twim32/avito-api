# Avito PHP SDK

Unofficial PHP SDK for [Avito.ru](https://avito.ru)

## Examples
```php
use Twim32\AvitoApi\Client;
use Twim32\AvitoApi\Service\Messenger;
use Twim32\AvitoApi\Service\Tariff;
use Twim32\AvitoApi\Service\User;
use Twim32\AvitoApi\Service\Autoload;

$client_id = '';
$client_secret = '';
$token = '';
$expires_in = 86400;
$token_type = 'Bearer';
$user_id = 0;
$chat_id = '';


$client = new Client;
$client->client_id = $client_id;
$client->client_secret = $client_secret;
// Get token from server
$client->authenticate($client_id, $client_secret);
// Or log in to your account if you already have token
$client->setToken($token, $expires_in, $token_type);

$a = new Autoload($client);
$response = $a->getReports();

$msr = new Messenger($client);
$response = $msr->getChats($user_id);
$response = $msr->getChat($user_id, $chat_id);
$response = $msr->getMessages($user_id, $chat_id);

$u = new User($client);
$response = $u->getUserBalance($user_id);

$t = new Tariff($client);
$response = $t->getInfo();

var_dump($response);
```