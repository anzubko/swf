<?php declare(strict_types=1);

namespace App\Listener;

use App\Event\DbSlowQueryEvent;
use App\Shared\Logger;
use App\Shared\Merger;
use App\Shared\Registry;
use App\Shared\Text;
use SWF\Attribute\AsListener;
use SWF\Event\BeforeControllerEvent;
use SWF\Event\LoggerEvent;
use SWF\Event\ResponseErrorEvent;
use SWF\Event\TransactionFailEvent;

class CommonListener
{
    #[AsListener(disposable: true)]
    public function assetsMerge(BeforeControllerEvent $event): void
    {
        shared(Registry::class)->merged = shared(Merger::class)->merge();
    }

    #[AsListener(persistent: true)]
    public function errorLog(LoggerEvent $event): void
    {
        if (null === config('common')->get('errorLog')) {
            return;
        }

        shared(Logger::class)->customLog(config('common')->get('errorLog'), $event->getComplexMessage());
    }

    #[AsListener(persistent: true)]
    public function errorDocument(ResponseErrorEvent $event): void
    {
        $errorDocument = config('common')->get('errorDocument');
        if (null === $errorDocument) {
            return;
        }

        $errorDocument = str_replace('{CODE}', (string) $event->getCode(), $errorDocument);
        if (is_file($errorDocument)) {
            include $errorDocument;
        }
    }

    #[AsListener(persistent: true)]
    public function transactionFail(TransactionFailEvent $event): void
    {
        if (null === config('transaction')->get('failLog')) {
            return;
        }

        $host = idn_to_utf8($_SERVER['HTTP_HOST']) . $_SERVER['REQUEST_URI'];

        $message = sprintf('[%s] [%d] %s', $event->getException()->getSqlState(), $event->getRetries(), $host);

        shared(Logger::class)->customLog(config('transaction')->get('failLog'), $message);
    }

    #[AsListener(persistent: true)]
    public function dbSlowQuery(DbSlowQueryEvent $event): void
    {
        if (null === config('db')->get('slowQueryLog')) {
            return;
        }

        $queries = [];
        foreach ($event->getQueries() as $query) {
            $queries[] = shared(Text::class)->fTrim($query);
        }

        $host = idn_to_utf8($_SERVER['HTTP_HOST']) . $_SERVER['REQUEST_URI'];

        $message = sprintf("[%.2f] %s\n\t%s\n", $event->getTimer(), $host, implode("\n\t", $queries));

        shared(Logger::class)->customLog(config('db')->get('slowQueryLog'), $message);
    }
}
