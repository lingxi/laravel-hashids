<?php

function trueId($publicId, $connection = null)
{
    $connection = getHashIdsConnection($connection);
    $id = app('hashids')->decode(substr($publicId, strlen(config('hashids.connections.' . $connection . '.prefix')), strlen($publicId)));

    return is_array($id) && isset($id[0]) ? $id[0] : null;
}

function publicId($id, $connection = null)
{
    $connection = getHashIdsConnection($connection);

    return config('hashids.connections.' . getHashIdsConnection() . '.prefix') . app('hashids')->encode($id);
}

function getHashIdsConnection($connection = null)
{
    return $connection ?: config('hashids.default');
}
