<?php

namespace Lingxi\Hashids;

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

class HashidsManager extends AbstractManager
{
    /**
     * The factory instance.
     *
     * @var \Lingxi\Hashids\HashidsFactory
     */
    private $factory;

    /**
     * Create a new Hashids manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \Lingxi\Hashids\HashidsFactory $factory
     *
     * @return void
     */
    public function __construct(Repository $config, HashidsFactory $factory)
    {
        parent::__construct($config);

        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return mixed
     */
    protected function createConnection(array $config)
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName()
    {
        return 'hashids';
    }

    /**
     * Get the factory instance.
     *
     * @return \Lingxi\Hashids\HashidsFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}
