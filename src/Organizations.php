<?php

namespace Gentor\Kayako;

/**
 * Class Organizations
 * @package Gentor\Kayako
 */
class Organizations
{
    /** @var Client $client */
    private $client;

    /**
     * @var string
     */
    protected $endPoint = 'api/v1/organizations';

    /**
     * Organizations constructor.
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
        return $this->client->delete($this->endPoint . '/' . (int)$id);
    }

    /**
     * @param array $ids
     * @return mixed
     */
    public function deleteByIds(array $ids)
    {
        $options = ['ids' => implode(',', $ids)];

        return $this->client->delete($this->endPoint, $options);
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function get(array $options = [])
    {
        return $this->client->get($this->endPoint, $options);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->client->get($this->endPoint . '/' . (int)$id);
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