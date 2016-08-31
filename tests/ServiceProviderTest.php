<?php

namespace Lingxi\Tests\Hashids;

use GrahamCampbell\TestBenchCore\ServiceProviderTrait;
use Hashids\Hashids;
use Lingxi\Hashids\HashidsFactory;
use Lingxi\Hashids\HashidsManager;

class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testHashidsFactoryIsInjectable()
    {
        $this->assertIsInjectable(HashidsFactory::class);
    }

    public function testHashidsManagerIsInjectable()
    {
        $this->assertIsInjectable(HashidsManager::class);
    }

    public function testBindings()
    {
        $this->assertIsInjectable(Hashids::class);

        $original = $this->app['hashids.connection'];
        $this->app['hashids']->reconnect();
        $new = $this->app['hashids.connection'];

        $this->assertNotSame($original, $new);
        $this->assertEquals($original, $new);
    }
}
