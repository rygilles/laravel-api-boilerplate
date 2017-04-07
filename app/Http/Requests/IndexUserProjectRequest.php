<?php

namespace App\Http\Requests;

class IndexUserProjectRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_role_id' => 'exists:user_role,id|in:Owner,Administrator'
        ];
    }
}
