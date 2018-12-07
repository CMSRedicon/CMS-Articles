<?php
namespace Redicon\CMS_Articles\App\Repositories;

use Redicon\CMS_Articles\App\Models\ArticlesCategoriesDescription;

class ArticlesCategoriesRepo extends Repositories
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Update zasobu
     *
     * @param array $data
     * @param ArticlesCategoriesDescription $articlesCategoriesDescription
     * @return void
     */
    public function update(array $data, ArticlesCategoriesDescription $articlesCategoriesDescription): bool
    {

        if (isset($data['position'])) {
            $articlesCategoriesDescription->ArticlesCategories()->update($data);
        }

        if (isset($data['name'])) {
            $articlesCategoriesDescription->name = $data['name'];
            $articlesCategoriesDescription->save();
        }

        return true;
    }

}
