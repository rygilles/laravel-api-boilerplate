<?php

namespace App\Http\Requests;

use App\Models\I18nLang;

class UpdateI18nLangRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('PATCH')) {
            return $this->filterWithModelConfiguration(I18nLang::class, I18nLang::getPatchRules());
        } elseif ($this->isMethod('PUT')) {
            return $this->filterWithModelConfiguration(I18nLang::class, I18nLang::getPutRules());
        } else {
            // @fixme Api documentation generator method "GET" for update... return PUT method rules
            return $this->filterWithModelConfiguration(I18nLang::class, I18nLang::getPutRules());
        }
    }
}
