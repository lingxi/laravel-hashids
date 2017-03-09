<?php

function trueId($publicId, $connection = null)
{
    $connection = getHashIdsConnection($connection);

    $hashids = app('hashids')->connection($connection);
    $id = $hashids->decode(substr($publicId, strlen(config('hashids.connections.' . $connection . '.prefix')), strlen($publicId)));

    return is_array($id) && isset($id[0]) ? $id[0] : null;
}

function publicId($id, $connection = null)
{
    $connection = getHashIdsConnection($connection);

    $hashids = app('hashids')->connection($connection);

    return config('hashids.connections.' . $connection . '.prefix') . $hashids->encode($id);
}

function getHashIdsConnection($connection = null)
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
