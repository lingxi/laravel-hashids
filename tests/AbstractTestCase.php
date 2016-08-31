<?php

namespace Lingxi\Tests\Hashids;

use GrahamCampbell\TestBench\AbstractPackageTestCase;
use Lingxi\Hashids\HashidsServiceProvider;

abstract class AbstractTestCase extends AbstractPackageTestCase
{
    /**
     * Get the service provider class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return string
     */
    protected function getServiceProviderClass($app)
    {
        return HashidsServiceProvider::class;
    }
}
