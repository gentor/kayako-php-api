<?php

namespace Gentor\Kayako;

/**
 * Class Locales
 * @package Gentor\Kayako
 * @see https://developer.kayako.com/api/v1/general/locales/
 */
class Locales
{
    /** @var Client $client */
    private $client;

    /**
     * @var string
     */
    protected $endPoint = 'api/v1/locales';

    /**
     * Locales constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $id
     * @param array $options
     * @return mixed
     */
    public function update($id, array $options)
    {
        return $this->client->put($this->endPoint . '/' . (int)$id, $options);
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function get(array $options = [])
    {
        return $this->client->get($this->endPoint, $options, false);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->client->get($this->endPoint . '/' . (int)$id, [], false);
    }
}