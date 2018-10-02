<?php
namespace Redicon\CMS_Articles\Database\Seeds;
use Illuminate\Database\Seeder;
use Redicon\CMS_Articles\App\Models\ArticlesCategories;

class ArticlesCategoriesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ArticlesCategories::create([
            'position' => 1
        ]);
    }
}
