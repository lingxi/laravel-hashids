<?php

namespace Lingxi\Hashids\ModelTraits;

use Lingxi\Hashids\Hashids;

trait PublicId
{
    public function getPublicIdAttribute($connection = null)
    {
        $primaryKey = $this->primaryKey;

        return Hashids::publicId($this->$primaryKey, $connection);
    }

    public static function findByPublicId($publicId, $connection = null)
    {
        $id = Hashids::trueId($publicId, $connection);

        return $id ? self::find($id) : null;
    }

    public static function getPublicIdMaxInt()
    {
        return app('hashids')->get_max_int_value();
    }
}
