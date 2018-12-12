<?php

namespace Gentor\Kayako;


use Illuminate\Support\Str;

/**
 * Class KayakoService
 *
 * @package Gentor\Kayako
 */
class KayakoService
{
    public $client;

    /**
     * KayakoService constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->client = new Client($config);
    }

    public function users()
    {
        return $this->client->users;
    }

    public function organizations()
    {
        return $this->client->organizations;
    }

    public function cases()
    {
        return $this->client->cases;
    }

    public function emails()
    {
        return $this->client->emails;
    }

    public function phones()
    {
        return $this->client->phones;
    }

    public function webhook()
    {
        return $this->client->webhook;
    }

    public function locales()
    {
        return $this->client->locales;
    }

    /**
     * @param       $method
     * @param array $args
     * @return mixed
     * @throws KayakoException
     */
    public function __call($method, array $args)
    {
        $call = explode('_', Str::snake($method), 2);
        $module = Str::plural($call[0]);

        if (!property_exists($this->client, $module)) {
            throw new KayakoException("Kayako module {$module} not found");
        }

        if (!isset($call[1])) {
            throw new KayakoException("Kayako method for module {$module} is not set");
        }

        $method = Str::camel($call[1]);
        if (!method_exists($this->client->{$module}, $method)) {
            throw new KayakoException("Kayako method {$method} for module {$module} not found");
        }

        return call_user_func_array([$this->client->{$module}, $method], $args);
    }
}