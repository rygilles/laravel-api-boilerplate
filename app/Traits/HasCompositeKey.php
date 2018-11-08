<?php

namespace App\Traits;

use Exception;
use Illuminate\Database\Eloquent\Builder;

/**
 * Use this trait if your model has a composite primary key.
 * The primary key should then be an array with all applicable columns.
 *
 * Class HasCompositeKey
 */
trait HasCompositeKey
{
    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Set the keys for a save update query.
     *
     * @param Builder $query
     * @return Builder
     * @throws Exception
     */
    protected function setKeysForSaveQuery(Builder $query)
    {
        $keyNames = $this->getKeyName();

        if (! is_array($keyNames)) {
            throw new \Exception('HasCompositeKey trait : Model key name must be a string array');
        }

        foreach ($keyNames as $keyName) {
            $keyForSaveQuery = isset($this->original[$keyName])
                ? $this->original[$keyName]
                : $this->getAttribute($keyName);

            $query->where($keyName, '=', $keyForSaveQuery);
        }

        return $query;
    }
}
