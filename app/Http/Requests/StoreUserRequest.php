<?php

namespace App\Http\Requests;

use App\Models\User;

class StoreUserRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->filterWithModelConfiguration(User::class, User::getStoreRules());
    }
}
