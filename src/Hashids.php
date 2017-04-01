<?php

namespace Lingxi\Hashids;

use InvalidArgumentException;

class Hashids
{
    public function trueId($publicId, $connection = null)
    {
        $connection = $this->getHashIdsConnection($connection);

        $hashids = app('hashids')->connection($connection);
        $hash = substr($publicId, strlen(config('hashids.connections.' . $connection . '.prefix')));
        $id = $hashids->decode($hash);

        if (is_array($id)) {
            switch (count($id)) {
                case 0:
                    return null;

                case 1:
                    return $id[0];

                default:
                    return $id;
            }
        } else {
            return null;
        }
    }

    public function publicId($id, $connection = null)
    {
        $connection = $this->getHashIdsConnection($connection);

        $hashids = app('hashids')->connection($connection);

        return config('hashids.connections.' . $connection . '.prefix') . $hashids->encode($id);
    }

    protected function getHashIdsConnection($connection = null)
    {
        if ($connection) {
            if (! isset(config('hashids.connections')[$connection])) {
                throw new InvalidArgumentException('hashids ' . $connection . ' not config.');
            }

            return $connection;
        } else {
            return config('hashids.default');
        }
    }
}