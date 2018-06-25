<?php declare(strict_types=1);

namespace App\Libs;

use Nette\Utils\Finder;

class FileLoader
{

    public function getFileNames()
    {
        $fileNames = [];
        foreach (Finder::findFiles('*.mp3')->in(__DIR__ . '/../../../www/files/mp3/') as $key => $file) {

            $fileName = explode('/', (string)$file);
            $fileNames[] = explode('.', end($fileName))[0];
        }

        return $fileNames;
    }

}
