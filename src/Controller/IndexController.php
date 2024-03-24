<?php declare(strict_types=1);

namespace App\Controller;

use App\Shared\Response;
use SWF\AbstractBase;
use SWF\Attribute\AsController;

class IndexController extends AbstractBase
{
    #[AsController('/')]
    public function index(): void
    {
        $phrase = 'Hello! This is Simplest framework :)';

        $this->s(Response::class)->template('regular.index.html', [
            'phrase' => $phrase,
        ]);
    }
}
