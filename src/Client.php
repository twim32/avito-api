<?php

namespace Twim32\AvitoApi;

use GuzzleHttp\Client as GuzzleHttp;
use Psr\Http\Message\ResponseInterface;

class Client
{	
	public string $client_id;
	public string $client_secret;

	public ?string $access_token = null;

	public int $expires_in;

	public string $token_type;

	private GuzzleHttp $http;

	public function __construct()
	{
		$this->http = new GuzzleHttp([
			'base_uri' => 'https://api.avito.ru/',
		]);
	}

	public function authenticate(string $client_id, string $client_secret): self
	{
		$this->client_id = $client_id;
		$this->client_secret = $client_secret;
	
		$response = $this->http->post('token', [
            'form_params' => [
				'grant_type' => 'client_credentials',
				'client_id' => $client_id,
				'client_secret' => $client_secret,
				],
			'headers' => ['Content-Type' => 'application/x-www-form-urlencoded'],
        ]);

		$options = json_decode($response->getBody()->getContents());
		
		return $this->authorize($options->access_token, $options->expires_in, $options->token_type);
	}

	public function authorize(string $access_token, int $expires_in, string $token_type): self
	{
		$this->access_token = $access_token;
		$this->expires_in = $expires_in;
		$this->token_type = $token_type;
		return $this;
	}

	public function post(string $url, array $form_params = [], array $headers = []): array
	{
		if($this->isAuthenticated())
			$headers['Authorization'] = "{$this->token_type} {$this->access_token}";

		$response = $this->http->post($url, [
            'form_params' => $form_params,
			'headers' => $headers,
        ]);

		return $this->handleResponse($response);
	}

	public function handleResponse(ResponseInterface $response): array
	{
		if($response->getStatusCode() === 200) {
			return json_decode($response->getBody()->getContents(), true);
		}
		throw new \Exception('Invalid status code');
	}

	public function get(string $uri, array $form_params = [], array $headers = []): array
	{
		if($this->isAuthenticated())
			$headers['Authorization'] = "{$this->token_type} {$this->access_token}";
	
		$response = $this->http->get($uri, [
            'form_params' => $form_params,
			'headers' => $headers,
        ]);

		return $this->handleResponse($response);
	}

	public function isAuthenticated(): bool
	{
		return (bool) $this->access_token;
	}
}
