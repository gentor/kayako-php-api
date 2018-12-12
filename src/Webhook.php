<?php

namespace Gentor\Kayako;

/**
 * Class Webhook
 * @package Gentor\Kayako
 * @see https://developer.kayako.com/api/v1/event/events/#Incoming-webhook
 */
class Webhook
{
    /** @var Client $client */
    private $client;

    /**
     * @var string
     */
    protected $endPoint = 'api/v1/webhook/';

    /**
     * Webhook constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $token
     * @param $event
     * @param array $options
     * @return mixed
     */
    public function send($token, $event, array $options)
    {
        return $this->client->post($this->endPoint . $token . '/incoming', array_merge([
            'event' => $event
        ], $options));
    }
}