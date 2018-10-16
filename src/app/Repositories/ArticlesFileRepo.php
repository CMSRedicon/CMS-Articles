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
    public static function saveArticleImage(string $path, UploadedFile $file)
    {
       
        $helper = new FileRepo(self::DISK);
        $helper->checkAndMakeDir($path);

        $filename = $file->getClientOriginalName();
        $file->storeAs($path, $filename, self::DISK);

        return $path . '/' . $filename;
    }

    /**
     * Usunięcie pliku
     *
     * @param String $pathToDelete
     * @return void
     */
    public static function deleteArticleFiles(String $pathToDelete){
        $allFiles = Storage::disk(self::DISK)->files($pathToDelete);
        Storage::disk(self::DISK)->delete($allFiles);
    }

}
