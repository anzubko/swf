<?php declare(strict_types=1);

namespace App\Listener;

use App\Event\DbSlowQueryEvent;
use App\Shared\Db;
use App\Shared\Logger;
use App\Shared\Merger;
use App\Shared\Registry;
use App\Shared\Template;
use App\Shared\Text;
use SWF\Attribute\AsListener;
use SWF\Event\BeforeControllerEvent;
use SWF\Event\BeforeResponseSendEvent;
use SWF\Event\LoggerEvent;
use SWF\Event\ResponseErrorEvent;
use SWF\Event\TransactionFailEvent;
use function is_string;

class CommonListener
{
    #[AsListener(persistent: true)]
    public function mergingAssets(BeforeControllerEvent $event): void
    {
        shared(Registry::class)->merged = shared(Merger::class)->merge();
    }

    #[AsListener(persistent: true)]
    public function customErrorLog(LoggerEvent $event): void
    {
        if (null === config('common')->get('errorLog')) {
            return;
        }

        shared(Logger::class)->customLog(config('common')->get('errorLog'), $event->getComplexMessage());
    }

    #[AsListener(persistent: true)]
    public function customErrorDocument(ResponseErrorEvent $event): void
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
    public function logTransactionFail(TransactionFailEvent $event): void
    {
        if (null === config('transaction')->get('failLog')) {
            return;
        }

        $host = idn_to_utf8($_SERVER['HTTP_HOST']) . $_SERVER['REQUEST_URI'];

        $message = sprintf('[%s] [%d] %s', $event->getException()->getSqlState(), $event->getRetries(), $host);

        shared(Logger::class)->customLog(config('transaction')->get('failLog'), $message);
    }

    #[AsListener(persistent: true)]
    public function logDbSlowQuery(DbSlowQueryEvent $event): void
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

    #[AsListener(persistent: true)]
    public function addStatsToHtmlResponse(BeforeResponseSendEvent $event): void
    {
        $body = $event->getBody();
        if (!is_string($body) || !$event->getHeaders()->contains('Content-Type', 'text/html')) {
            return;
        }

        $timer = gettimeofday(true) - APP_STARTED;
        $body .= sprintf(
            '<!-- script %.3f + sql(%d) %.3f + tpl(%d) %.3f = %.3f -->',
            $timer - shared(Db::class)->getTimer() - shared(Template::class)->getTimer(),
            shared(Db::class)->getCounter(),
            shared(Db::class)->getTimer(),
            shared(Template::class)->getCounter(),
            shared(Template::class)->getTimer(),
            $timer,
        );

        $event->setBody($body);
    }
}
