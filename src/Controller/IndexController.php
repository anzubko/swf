<?php
declare(strict_types=1);

namespace App\Controller;

use App\Shared\Response;
use SWF\Attribute\AsController;
use Throwable;

class IndexController
{
    /**
     * @throws Throwable
     */
    #[AsController('/')]
    public function index(): void
    {
        $phrase = 'Hello! This is Simplest framework :)';

        i(Response::class)->template('regular.index.html', ['phrase' => $phrase]);
    }
}
