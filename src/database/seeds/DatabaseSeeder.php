<?php
namespace Redicon\CMS_Articles\Database\Seeds;
use Illuminate\Database\Seeder;
use Redicon\CMS_Articles\App\Models\Articles;
use Redicon\CMS_Articles\Database\Seeds\ArticlesSeed;
use Redicon\CMS_Articles\Database\Seeds\ArticlesCategoriesSeed;
use Redicon\CMS_Articles\Database\Seeds\ArticlesDescriptionSeed;
use Redicon\CMS_Articles\Database\Seeds\ArticlesCategoriesDescriptionSeed;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ArticlesCategoriesSeed::class);
        $this->call(ArticlesCategoriesDescriptionSeed::class);
        $this->call(ArticlesSeed::class);
        $this->call(ArticlesDescriptionSeed::class);
        $this->call(ArticlesSeoSeed::class);
    }
}
