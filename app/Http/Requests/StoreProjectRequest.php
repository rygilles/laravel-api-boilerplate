<?php

namespace App\Http\Requests;

use App\Models\Project;

class StoreProjectRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->filterWithModelConfiguration(Project::class, Project::getStoreRules());
    }
}
