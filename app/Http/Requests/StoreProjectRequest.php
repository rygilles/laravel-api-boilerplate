<?php

namespace App\Http\Requests;

use Dingo\Api\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'search_engine_id'  => 'required|exists:search_engine,id',
            'data_stream_id'    => 'exists:data_stream,id',
            'name'              => 'required|string|max:100'
        ];
    }
}
