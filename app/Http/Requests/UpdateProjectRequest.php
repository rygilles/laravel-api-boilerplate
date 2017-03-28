<?php

namespace App\Http\Requests;

use Dingo\Api\Http\FormRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Model validation rules for item patch
     * @var array
     */
    protected static $patchRules = [
        'search_engine_id'  => 'exists:search_engine,id',
        'data_stream_id'    => 'exists:data_stream,id',
        'name'              => 'string|max:100'
    ];

    /**
     * Model validation rules for item replacement
     * @var array
     */
    protected static $putRules = [
        'search_engine_id'  => 'required|exists:search_engine,id',
        'data_stream_id'    => 'exists:data_stream,id',
        'name'              => 'required|string|max:100'
    ];

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
	    if ($this->isMethod('PATCH')) {
		    return self::$patchRules;
	    } elseif ($this->isMethod('PUT')) {
		    return self::$putRules;
	    } else {
		    // @fixme Api documentation generator method "GET" for update... return PUT method rules
		    // dd($this);
		    return self::$putRules;
	    }
    }
}
