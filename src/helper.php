<?php

use Hashids\Hashids;

function trueId($publicId, $connection = null)
{
    $connection = getHashIdsConnection($connection);
    $id = Hashids::decode(substr($publicId, strlen(config('hashids.connections.' . $connection . '.prefix')), strlen($publicId)));

    return is_array($id) && isset($id[0]) ? $id[0] : null;
}

function publicId($id, $connection = null)
{
    $connection = getHashIdsConnection($connection);

    return config('hashids.connections.' . getHashIdsConnection() . '.prefix') . Hashids::encode($id);
}

function getHashIdsConnection($connection = null)
{
    $connection = getHashIdsConnection($connection);

    return $connection ?: config('hashids.default');
}
