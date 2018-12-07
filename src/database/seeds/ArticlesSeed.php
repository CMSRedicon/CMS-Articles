<?php
namespace Redicon\CMS_Articles\Database\Seeds;
use Illuminate\Database\Seeder;
use Redicon\CMS_Articles\App\Models\Articles;

class ArticlesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Articles::create([
            'parent_id' => null,
            'article_category_id' => 1,
            'in_menu' => 1,
            'is_public' => 1,
            'order' => 1,
        ]);
    }
}
