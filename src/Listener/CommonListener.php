<?php declare(strict_types=1);

namespace App\Listener;

use App\Event\DbSlowQueryEvent;
use App\Shared\Config;
use App\Shared\Logger;
use App\Shared\Merger;
use App\Shared\Registry;
use App\Shared\Text;
use SWF\AbstractBase;
use SWF\Attribute\AsListener;
use SWF\Event\BeforeControllerEvent;
use SWF\Event\LoggerEvent;
use SWF\Event\ResponseErrorEvent;
use SWF\Event\TransactionFailEvent;

class CommonListener extends AbstractBase
{
    #[AsListener(disposable: true)]
    public function assetsMerge(BeforeControllerEvent $event): void
    {
        $this->s(Registry::class)->merged = $this->s(Merger::class)->merge();
    }

    #[AsListener(persistent: true)]
    public function errorLog(LoggerEvent $event): void
    {
        if (null === $this->s(Config::class)->get('common', 'errorLog')) {
            return;
        }

        $this->s(Logger::class)->customLog($this->s(Config::class)->get('common', 'errorLog'), $event->getComplexMessage());
    }

    #[AsListener(persistent: true)]
    public function errorDocument(ResponseErrorEvent $event): void
    {
        $errorDocument = $this->s(Config::class)->get('common', 'errorDocument');
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
        if (null === $this->s(Config::class)->get('transaction', 'failLog')) {
            return;
        }

        $host = idn_to_utf8($_SERVER['HTTP_HOST']) . $_SERVER['REQUEST_URI'];

        $message = sprintf('[%s] [%d] %s', $event->getException()->getSqlState(), $event->getRetries(), $host);

        $this->s(Logger::class)->customLog($this->s(Config::class)->get('transaction', 'failLog'), $message);
    }

    #[AsListener(persistent: true)]
    public function dbSlowQuery(DbSlowQueryEvent $event): void
    {
        if (null === $this->s(Config::class)->get('db', 'slowQueryLog')) {
            return;
        }

        $queries = [];
        foreach ($event->getQueries() as $query) {
            $queries[] = $this->s(Text::class)->fTrim($query);
        }

        $host = idn_to_utf8($_SERVER['HTTP_HOST']) . $_SERVER['REQUEST_URI'];

        $message = sprintf("[%.2f] %s\n\t%s\n", $event->getTimer(), $host, implode("\n\t", $queries));

        $this->s(Logger::class)->customLog($this->s(Config::class)->get('db', 'slowQueryLog'), $message);
    }
}
