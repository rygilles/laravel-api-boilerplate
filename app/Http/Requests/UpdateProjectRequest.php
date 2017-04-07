<?php

namespace App\Http\Requests;

use App\Models\Project;

class UpdateProjectRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
	    if ($this->isMethod('PATCH')) {
		    return $this->filterWithModelConfiguration(Project::class, Project::getPatchRules());
	    } elseif ($this->isMethod('PUT')) {
		    return $this->filterWithModelConfiguration(Project::class, Project::getPutRules());
	    } else {
		    // @fixme Api documentation generator method "GET" for update... return PUT method rules
		    return $this->filterWithModelConfiguration(Project::class, Project::getPutRules());
	    }
    }
}
