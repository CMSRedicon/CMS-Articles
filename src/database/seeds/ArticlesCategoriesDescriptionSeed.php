<?php
namespace Redicon\CMS_Articles\Database\Seeds;
use Illuminate\Database\Seeder;
use Redicon\CMS_Articles\App\Models\ArticlesCategoriesDescription;

class ArticlesCategoriesDescriptionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ArticlesCategoriesDescription::create([
            'article_category_id' => 1,
            'name' => 'główna',
            'lang' => 'pl',
        ]);
        ArticlesCategoriesDescription::create([
            'article_category_id' => 1,
            'name' => 'main',
            'lang' => 'en',
        ]);

        ArticlesCategoriesDescription::create([
            'article_category_id' => 2,
            'name' => 'body',
            'lang' => 'pl',
        ]);
        ArticlesCategoriesDescription::create([
            'article_category_id' => 2,
            'name' => 'body',
            'lang' => 'en',
        ]);
    }
}
