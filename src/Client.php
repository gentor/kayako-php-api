<?php

namespace Gentor\Kayako;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;
use function GuzzleHttp\Psr7\stream_for;

/**
 * Class Client
 * @package Gentor\Kayako
 */
class Client
{
    /** @var Client $httpClient */
    private $httpClient;

    protected $endPoint;
    protected $clientId;
    protected $clientSecret;
    protected $username;
    protected $password;
    protected $accessToken;

    public $users;

    public $organizations;

    public $cases;

    public $webhook;

    /**
     * Client constructor.
     * @param array $config
     */
    public function __construct($config)
    {
        $this->httpClient = new HttpClient();
        $this->endPoint = $config['base_url'];
        $this->clientId = $config['client_id'];
        $this->clientSecret = $config['client_secret'];
        $this->username = $config['username'];
        $this->password = $config['password'];

        $this->users = new Users($this);
        $this->organizations = new Organizations($this);
        $this->cases = new Cases($this);
        $this->webhook = new Webhook($this);
    }

    public function getToken()
    {
        $response = $this->request('post', 'oauth/token', [
            'grant_type' => 'password',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'username' => $this->username,
            'password' => $this->password
        ], false);

        $this->accessToken = $response->access_token;

        return $response;
    }

    /**
     * @param $endpoint
     * @param array $query
     * @return mixed
     */
    public function get($endpoint, $query = [])
    {
        return $this->request('get', $endpoint, $query);
    }

    /**
     * @param $endpoint
     * @param array $options
     * @return mixed
     */
    public function post($endpoint, array $options = [])
    {
        return $this->request('post', $endpoint, $options);
    }

    /**
     * @param $endpoint
     * @param array $options
     * @return mixed
     */
    public function put($endpoint, array $options)
    {
        return $this->request('put', $endpoint, $options);
    }

    /**
     * @param $endpoint
     * @return mixed
     */
    public function delete($endpoint)
    {
        return $this->request('delete', $endpoint);
    }

    /**
     * @param $method
     * @param $endpoint
     * @param array $options
     * @param bool $requireToken
     * @return mixed
     */
    public function request($method, $endpoint, array $options = [], $requireToken = true)
    {
        if ($requireToken && !$this->accessToken) {
            $this->getToken();
        }

        $format = 'json';
        if (strtolower($method) == 'get') {
            $format = 'query';
        }

        try {
            $response = $this->httpClient->request(
                $method,
                $this->endPoint . $endpoint,
                array_merge($this->setHeaders(), [$format => $options])
            );
        } catch (ClientException $e) {
            return $this->handleException($e);
        }

        return $this->handleResponse($response);
    }

    /**
     * @param ClientException $exception
     * @return mixed
     */
    protected function handleException(ClientException $exception)
    {
        $response = $exception->getResponse();

        return $this->handleResponse($response);
    }

    /**
     * @return array
     */
    private function setHeaders()
    {
        return [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ]
        ];
    }

    /**
     * @param Response $response
     * @return mixed
     */
    private function handleResponse(Response $response)
    {
        $stream = stream_for($response->getBody());
        $data = json_decode($stream);
        return $data;
    }
}