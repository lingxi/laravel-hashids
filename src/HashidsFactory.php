<?php

namespace Lingxi\Hashids;

use Hashids\Hashids as HashId;

class HashidsFactory
{
    /**
     * Make a new Hashids client.
     *
     * @param array $config
     *
     * @return \Hashids\Hashids
     */
    public function make(array $config)
    {
        $config = $this->getConfig($config);

        return $this->getClient($config);
    }

    /**
     * Get the configuration data.
     *
     * @param array $config
     *
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    protected function getConfig(array $config)
    {
        return [
            'salt' => array_get($config, 'salt', ''),
            'length' => array_get($config, 'length', 0),
            'alphabet' => array_get($config, 'alphabet', ''),
        ];
    }

    /**
     * Get the hashids client.
     *
     * @param array $config
     *
     * @return \Hashids\Hashids
     */
    protected function getClient(array $config)
    {
        return new HashId($config['salt'], $config['length'], $config['alphabet']);
    }
}
