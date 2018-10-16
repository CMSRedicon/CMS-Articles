<?php

namespace Redicon\CMS_Articles\App\Models;

use Illuminate\Database\Eloquent\Model;
use Redicon\CMS_Articles\App\Models\ArticlesCategories;
use Redicon\CMS_Articles\App\Models\ArticlesDescription;
use Redicon\CMS_Articles\App\Models\ArticlesLogs;

class Articles extends Model
{
    protected $table = 'articles';
    protected $fillable = ['parent_id', 'article_category_id', 'template', 'in_menu', 'is_public', 'order', 'created_at', 'updated_at'];
    protected $visible = ['id', 'parent_id', 'article_category_id', 'template', 'in_menu', 'is_public', 'order', 'created_at', 'updated_at'];
    public $single = false;

    public function ArticlesCategories()
    {
        return $this->belongsTo(ArticlesCategories::class, 'article_category_id');
    }

    public function ArticlesLogs()
    {
        return $this->hasMany(ArticlesLogs::class, 'article_id', 'id');
    }

    public function ArticlesDescription()
    {
        return $this->hasMany(ArticlesDescription::class, 'article_id', 'id');
    }

    /**
     * Filtr po języku
     *
     * @param [type] $query
     * @param [type] $lang
     * @return void
     */
    public function scopeByLanguage($query,$lang){
 
        return $query->whereHas('articlesDescription', function($qq) use($lang){
            $qq->where('lang', $lang);
        });
    }

    /**
     * Zwraca ArticleDescription ale tylko gdzie lang jest pl
     * Tylko wyświetlanie
     *
     * @return void
     */
    public function PolishArticlesDescription()
    {
        return $this->hasOne(ArticlesDescription::class, 'article_id', 'id')->where('lang', 'pl');
    }
    
    /**
     * Zwraca ArticleDescription ale tylko gdzie lang jest eng
     * Tylko wyświetlanie
     *
     * @return void
     */
    public function EnglishArticlesDescription()
    {
        return $this->hasOne(ArticlesDescription::class, 'article_id', 'id')->where('lang', 'en');
    }
}
