<?php

namespace App\Http\Transformers\Api;

use Illuminate\Support\Facades\Auth;
use League\Fractal\TransformerAbstract;

class ApiTransformer extends TransformerAbstract
{
    /**
     * Alter transformed data table using models configuration.
     *
     * @param string $modelClass
     * @param array $data
     * @return array
     */
    public function filterWithModelConfiguration($modelClass, array $data)
    {
        $modelsConfig = config('models');

        if (! isset($modelsConfig[$modelClass])) {
            return $data;
        }

        $config = $modelsConfig[$modelClass];

        if (! isset($config['attributes'])) {
            return $data;
        }

        foreach ($config['attributes'] as $attribute => $attributeConfig) {
            if (isset($attributeConfig['apiCannotReadOnUserGroups'])) {
                // Filter user only if already authenticated
                if (Auth::user()) {
                    if (in_array(Auth::user()->user_group_id, $attributeConfig['apiCannotReadOnUserGroups'])) {
                        unset($data[$attribute]);
                    }
                }
            }
        }

        return $data;
    }
}
