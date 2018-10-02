<?php

namespace Redicon\CMS_Articles\App\Models;
use Illuminate\Database\Eloquent\Model;
use Redicon\CMS_Articles\App\Models\Articles;

class ArticlesDescription extends Model
{
   protected $table = 'articles_description';
   protected $visible = ['id', 'article_id', 'url', 'lang', 'name', 'addmission', 'description', 'link', 'img_src', 'created_at', 'updated_at'];
   protected $fillable = ['article_id', 'url', 'lang', 'name', 'addmission', 'description', 'link', 'img_src', 'created_at', 'updated_at'];

   public function Articles(){
       return $this->belongsTo(Articles::class , 'article_id');
   }
}
