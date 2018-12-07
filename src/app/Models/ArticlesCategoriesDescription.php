<?php

namespace Redicon\CMS_Articles\App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticlesCategoriesDescription extends Model
{
    protected $table = 'articles_categories_description';
    protected $visible = ['id', 'article_category_id', 'name', 'lang', 'created_at', 'updated_at'];
    protected $fillable = ['article_category_id', 'name', 'lang', 'created_at', 'updated_at'];

    public function ArticlesCategories(){
        return $this->belongsTo(ArticlesCategories::class, 'article_category_id');
    }
   
}
