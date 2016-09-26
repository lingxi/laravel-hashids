<?php

namespace Lingxi\Hashids\ModelTraits;

trait PublicId
{
    public function getPublicIdAttribute($connection = null)
    {
        $primaryKey = $this->primaryKey;

        return publicId($this->$primaryKey, getHashIdsConnection($connection));
    }

    public static function findByPublicId($publicId, $connection = null)
    {
        $connection = getHashIdsConnection($connection);

        $id = trueid($publicId);

        return $id ? self::find($id) : null;
    }

    public static function getPublicIdMaxInt()
    {
        return app('hashids')->get_max_int_value();
    }
}
