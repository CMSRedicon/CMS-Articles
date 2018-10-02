<?php

namespace Redicon\CMS_Articles\App\Models;

use Illuminate\Database\Eloquent\Model;
use Redicon\CMS_Articles\App\Models\Articles;

class ArticlesLogs extends Model
{
    protected $table = 'articles_logs';
    protected $visible = ['id', 'article_id', 'vars', 'created_at', 'updated_at'];
    protected $fillable = ['article_id', 'vars', 'created_at', 'updated_at'];
    protected $casts = [
        'vars' => 'json'
    ];

    public function Articles(){
        return $this->belongsTo(Articles::class, 'article_id');
    }
    
}
