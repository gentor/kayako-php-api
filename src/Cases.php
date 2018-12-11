<?php

namespace Gentor\Kayako;

/**
 * Class Cases
 * @package Gentor\Kayako
 */
class Cases
{
    /** @var Client $client */
    private $client;

    /**
     * @var string
     */
    protected $endPoint = 'api/v1/cases';

    /**
     * Cases constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function create(array $options)
    {
        return $this->client->post($this->endPoint, $options);
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
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->client->delete($this->endPoint . '/' .(int)$id);
    }

    /**
     * @param null $id
     * @return mixed
     */
    public function details($id = null)
    {
        $endpoint = $id ? $this->endPoint . '/' . (int)$id : $this->endPoint;

        return $this->client->get($endpoint);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->details($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findByLegacyId($id)
    {
        $response = $this->client->get($this->endPoint, ['legacy_ids' => $id]);

        if (!empty($response->total_count)) {
            $response->data = $response->data[0];
        }

        return $response;
    }
}