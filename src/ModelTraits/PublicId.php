<?php

trait PublicId
{
    public function getPublicIdAttribute($connection = null)
    {
        $primaryKey = $this->primaryKey;

        return publicId($primaryKey, getHashIdsConnection($connection));
    }

    public function findByPublicId($publicId, $connection = null)
    {
        $connection = getHashIdsConnection($connection);

        $id = trueid($publicId);

        return $id ? self::find($id) : null;
    }

    public static function getPublicIdMaxInt()
    {
        return Hashids::get_max_int_value();
    }
}
