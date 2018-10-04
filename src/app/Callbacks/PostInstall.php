<?php
namespace App\Callbacks;

use App\Interfaces\Runnable;

class PostInstall implements Runnable{

    public function run(){

        echo 'PostInstall' . PHP_EOL;
    }

}