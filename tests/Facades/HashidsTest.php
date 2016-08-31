<?php

namespace Lingxi\Tests\Hashids\Facades;

use GrahamCampbell\TestBenchCore\FacadeTrait;
use Lingxi\Hashids\Facades\Hashids;
use Lingxi\Hashids\HashidsManager;
use Lingxi\Tests\Hashids\AbstractTestCase;

class HashidsTest extends AbstractTestCase
{
    use FacadeTrait;

    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'hashids';
    }

    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return Hashids::class;
    }

    /**
     * Get the facade root.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return HashidsManager::class;
    }
}
