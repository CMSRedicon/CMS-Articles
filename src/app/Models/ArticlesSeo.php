<?php

namespace Redicon\CMS_Articles\App\Models;

use Illuminate\Database\Eloquent\Model;
use Redicon\CMS_Articles\App\Models\ArticlesDescription;

class ArticlesSeo extends Model
{
    protected $table= 'articles_seo';
    protected $fillable = ['articles_description_id', 'title','meta','keywords', 'created_at', 'updated_at'];
    protected $visible = ['id','articles_description_id', 'title','meta','keywords', 'created_at', 'updated_at'];

    public function ArticlesDescription(){
        return $this->belongsTo(ArticlesDescription::class, 'articles_description_id');
    }
}
