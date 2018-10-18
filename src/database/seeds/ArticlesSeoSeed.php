<?php
namespace Redicon\CMS_Articles\Database\Seeds;
use App\Models\GlobalSeo;
use Illuminate\Database\Seeder;
use Redicon\CMS_Articles\App\Models\ArticlesSeo;
use Redicon\CMS_Articles\App\Models\ArticlesDescription;

class ArticlesSeoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ArticlesSeo::create([
            'articles_description_id' => 1,
            'title' => 'Tytuł seo',
            'meta' => 'Opis',
            'keywords' => 'asda,sd,as,d,asd,s,fv,df,g,df',
        ]);

        GlobalSeo::create([
            'slug' => '/pl/glowny-artykul-opis',
            'instance' => ArticlesDescription::class,
            'instance_id' => 1,
            'lang' => 'pl'
        ]);
    }
}
