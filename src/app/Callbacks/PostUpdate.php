<?php
namespace App\Callbacks;

use App\Interfaces\Runnable;

class PostUpdate implements Runnable{

    public function run()
    {
        echo "PostUpdate" . PHP_EOL;
    }
}