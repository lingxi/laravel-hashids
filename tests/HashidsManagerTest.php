<?php

namespace Lingxi\Tests\Hashids;

use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use Hashids\Hashids;
use Illuminate\Contracts\Config\Repository;
use Mockery;
use Lingxi\Hashids\HashidsFactory;
use Lingxi\Hashids\HashidsManager;

class HashidsManagerTest extends AbstractTestBenchTestCase
{
    public function testCreateConnection()
    {
        $config = ['path' => __DIR__];

        $manager = $this->getManager($config);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('hashids.default')->andReturn('hashids');

        $this->assertSame([], $manager->getConnections());

        $return = $manager->connection();

        $this->assertInstanceOf(Hashids::class, $return);

        $this->assertArrayHasKey('hashids', $manager->getConnections());
    }

    protected function getManager(array $config)
    {
        $repository = Mockery::mock(Repository::class);
        $factory = Mockery::mock(HashidsFactory::class);

        $manager = new HashidsManager($repository, $factory);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('hashids.connections')->andReturn(['hashids' => $config]);

        $config['name'] = 'hashids';

        $manager->getFactory()->shouldReceive('make')->once()
            ->with($config)->andReturn(Mockery::mock(Hashids::class));

        return $manager;
    }
}
