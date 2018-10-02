<?php

namespace Redicon\CMS_Articles\App\Models;

use Illuminate\Database\Eloquent\Model;
use Redicon\CMS_Articles\App\Models\ArticlesLogs;
use Redicon\CMS_Articles\App\Models\ArticlesCategories;
use Redicon\CMS_Articles\App\Models\ArticlesDescription;

class Articles extends Model
{
    protected $table = 'articles';
    protected $fillable = ['parent_id', 'article_category_id', 'template', 'in_menu', 'is_public', 'order', 'created_at', 'updated_at'];
    protected $visible = ['id','parent_id', 'article_category_id', 'template', 'in_menu', 'is_public', 'order', 'created_at', 'updated_at'];

    public function ArticlesCategories(){
        return $this->belongsTo(ArticlesCategories::class, 'article_category_id');
    }

    public function ArticlesLogs(){
        return $this->hasMany(ArticlesLogs::class, 'article_id', 'id');
    }

    public function ArticlesDescription(){
        return $this->hasMany(ArticlesDescription::class, 'article_id', 'id');
    }

}
