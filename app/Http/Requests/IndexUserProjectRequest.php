<?php

namespace App\Http\Requests;

use Dingo\Api\Http\FormRequest;

class IndexUserProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

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
