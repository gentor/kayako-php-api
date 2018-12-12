<?php

namespace Gentor\Kayako;

/**
 * Class Emails
 * @package Gentor\Kayako
 * @see https://developer.kayako.com/api/v1/users/identities/#Emails
 */
class Emails
{
    /** @var Client $client */
    private $client;

    /**
     * @var string
     */
    protected $endPoint = 'api/v1/identities/emails';

    /**
     * Emails constructor.
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
     * @param $user_id
     * @return mixed
     */
    public function get($user_id)
    {
        return $this->client->get($this->endPoint, ['user_id' => $user_id]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->client->get($this->endPoint . '/' . (int)$id);
    }
}