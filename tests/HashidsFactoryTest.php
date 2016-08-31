<?php

namespace Lingxi\Tests\Hashids;

use Hashids\Hashids;
use Lingxi\Hashids\HashidsFactory;

class HashidsFactoryTest extends AbstractTestCase
{
    public function testMakeStandard()
    {
        $factory = $this->getHashidsFactory();

        $return = $factory->make([
            'salt' => 'your-salt-string',
            'length' => 'your-length-integer',
            'alphabet' => 'your-alphabet-string',
        ]);

        $this->assertInstanceOf(Hashids::class, $return);
    }

    protected function getHashidsFactory()
    {
        return new HashidsFactory();
    }
}
