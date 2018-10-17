<?php

namespace Redicon\CMS_Articles\App\Http\Request\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticlesRequest extends FormRequest
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
            'name' => 'required',
            'lead' => 'nullable',
            'img_src' => 'nullable|max:4098',
            'article_category_id' => 'required|exists:articles_categories,id',
            'slug' => 'required',
            'articles_lang' => 'required|in:' . implode(',' , array_keys(config('languages')))
        ];
    }
}
