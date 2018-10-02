<?php

namespace Redicon\CMS_Articles\App\Models;

use Illuminate\Database\Eloquent\Model;
use Redicon\CMS_Articles\App\Models\ArticlesCategoriesDescription;

class ArticlesCategories extends Model
{
    protected $table = 'articles_categories';
    protected $visible = ['id', 'position', 'created_at', 'updated_at'];
    protected $fillable = ['position', 'created_at', 'updated_at'];

    public function Articles(){
        return $this->hasMany(Articles::class, 'article_category_id', 'id');
    }

    public function ArticlesCategoriesDescription(){
        return $this->hasMany(ArticlesCategoriesDescription::class, 'article_category_id', 'id');
    }
 
}
