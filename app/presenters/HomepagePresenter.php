<?php declare(strict_types=1);

namespace App\Presenters;

use App\Libs\FileLoader;
use Nette;

class HomepagePresenter extends Nette\Application\UI\Presenter
{

    /** @var FileLoader @inject */
    public $fileLoader;

    public function actionDefault()
    {
        $this->template->fileNames = $this->fileLoader->getFileNames();
    }

}
