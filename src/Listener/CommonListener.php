<?php declare(strict_types=1);

namespace App\Listener;

use App\Shared\Logger;
use App\Shared\Merger;
use App\Shared\Registry;
use SWF\AbstractBase;
use SWF\Attribute\AsListener;
use SWF\Event\BeforeControllerEvent;
use SWF\Event\TransactionFailEvent;

class CommonListener extends AbstractBase
{
    #[AsListener]
    public function assetsMerge(BeforeControllerEvent $event): void
    {
        $this->s(Registry::class)->merged = $this->s(Merger::class)->merge();
    }

    #[AsListener(persistent: true)]
    public function transactionFail(TransactionFailEvent $event): void
    {
        $this->s(Logger::class)->transactionFail(
            $event->getLevel(),
            $event->getException()->getSqlState(),
            $event->getRetry(),
        );
    }
}
