<?php

namespace Redicon\CMS_Articles\App\Http\Request\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticlesCategoriesRequest extends FormRequest
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
            'position' => 'required|integer|min:1'
        ];
    }
}
