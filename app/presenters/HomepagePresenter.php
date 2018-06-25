<?php declare(strict_types=1);

namespace App\Presenters;

use App\Model\Facade\FileRepository;
use Nette;

class HomepagePresenter extends Nette\Application\UI\Presenter
{

    /** @var FileRepository @inject */
    public $fileRepository;

    public function actionDefault()
    {
        $this->template->files = $this->fileRepository->findBy(
            [],
            ['order' => 'ASC']
        );
    }

}
