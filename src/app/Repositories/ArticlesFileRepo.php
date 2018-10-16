<?php
namespace Redicon\CMS_Articles\App\Repositories;

use App\Repositories\FileRepo;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ArticlesFileRepo
{

    public const DISK = "articles";

    /**
     * Zapis pliku
     *
     * @param integer $article_id
     * @param integer $article_description_id
     * @param UploadedFile $file
     * @return void
     */
    public static function saveArticleImage(int $article_id, int $article_description_id, UploadedFile $file)
    {
        $path = $article_id . '/' . $article_description_id;
        
        $helper = new FileRepo(self::DISK);
        $helper->checkAndMakeDir($path);

        $filename = $file->getClientOriginalName();
        $file->storeAs($path, $filename, self::DISK);

        return $path . '/' . $filename;
    }

}
