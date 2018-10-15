<?php
namespace Redicon\CMS_Articles\App\Http\Request\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticlesRequest extends FormRequest
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
            'articles_description_name' => 'required',
            'articles_description_lead' => 'nullable',
            'articles_description_img_src' => 'nullable|max:4098',
            'article_category_id' => 'required|exists:articles_categories,id',
            'articles_seo_slug' => 'required',
        ];
    }
}
