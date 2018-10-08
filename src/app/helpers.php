<?php
if(!function_exists('getArticleLanguageLinks')){

    /**
     * Zwraca języki w formie linków
     *
     * @return string
     */
    function getArticleLanguageLinks() : string{
        $languages = config('languages');
        $str = '';
        if(!empty($languages)){
            foreach ($languages as $code => $title) {
                $str.= '<a href="javascript:;">'.$title.'</a>';
            }

        }

        return $str;
        
    }

}