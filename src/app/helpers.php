<?php
if(!function_exists('getArticleLanguageEditLinks')){

    /**
     * Zwraca linki do edycji artykułów per lang
     *
     * @param integer $article_id
     * @return string
     */
    function getArticleLanguageEditLinks(int $article_id) : string{
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
if(!function_exists('getArticleLanguageCreateLinks')){

    /**
     * Zwraca linki do tworzenia artykułów per lang
     *
     * @param integer $article_id
     * @return string
     */
    function getArticleLanguageCreateLinks(String $lang = null) : string{
        $languages = config('languages');
        $str = '';
        if(!empty($languages)){
            foreach ($languages as $code => $title) {
                if(!is_null($lang) && $code == $lang){
                    $str.= '<a href="' . route('admin.articles.create',[$code]) .'" data-cmsr-trigger="clickArticleLangCreate"><strong>'.$title.'</strong></a><br>';
                }else{
                    $str.= '<a href="' . route('admin.articles.create',[$code]) .'" data-cmsr-trigger="clickArticleLangCreate">'.$title.'</a><br>';
                }
            }
        }
        return $str;
    }

}