<?php
if(!function_exists('getArticleLanguageLinks')){

    /**
     * Zwraca linki do edycji artykułów per lang
     *
     * @param integer $article_id
     * @return string
     */
    function getArticleLanguageLinks(int $article_id) : string{
        $languages = config('languages');
        $str = '';
        if(!empty($languages)){
            foreach ($languages as $code => $title) {
                $str.= '<a href="' . route('admin.articles.edit',[$article_id, $code]) .'">'.$title.'</a>';
            }
        }
        return $str;
    }

}