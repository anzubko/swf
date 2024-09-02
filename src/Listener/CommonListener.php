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
use SWF\Event\HttpErrorEvent;
use SWF\Event\ResponseEvent;
use SWF\Event\TransactionFailEvent;
use function is_string;

class CommonListener
{
    #[AsListener(persistent: true)]
    public function mergeAssets(BeforeControllerEvent $event): void
    {
        instance(Registry::class)->merged = instance(Merger::class)->merge();
    }

    #[AsListener(persistent: true)]
    public function customErrorDocument(HttpErrorEvent $event): void
    {
        $errorDocument = config('common')->get('errorDocument');
        if (null === $errorDocument) {
            return;
        }

        $errorDocument = strtr($errorDocument, ['{CODE}' => (string) $event->getCode()]);
        if (is_file($errorDocument)) {
            include $errorDocument;
        }
    }

    #[AsListener(persistent: true)]
    public function logTransactionFail(TransactionFailEvent $event): void
    {
        $failLog = config('transaction')->get('failLog');
        if (null === $failLog) {
            return;
        }

        $host = idn_to_utf8($_SERVER['HTTP_HOST']) . $_SERVER['REQUEST_URI'];

        $message = sprintf('[%s] [%d] %s', $event->getException()->getSqlState(), $event->getRetries(), $host);

        instance(Logger::class)->customLog($failLog, $message);
    }

    #[AsListener(persistent: true)]
    public function logDbSlowQuery(DbSlowQueryEvent $event): void
    {
        $slowQueryLog = config('db')->get('slowQueryLog');
        if (null === $slowQueryLog) {
            return;
        }

        $queries = [];
        foreach ($event->getQueries() as $query) {
            $queries[] = instance(Text::class)->fTrim($query);
        }

        $host = idn_to_utf8($_SERVER['HTTP_HOST']) . $_SERVER['REQUEST_URI'];

        $message = sprintf("[%.2f] %s\n\t%s\n", $event->getTimer(), $host, implode("\n\t", $queries));

        instance(Logger::class)->customLog($slowQueryLog, $message);
    }

    #[AsListener(persistent: true)]
    public function statsToHtmlResponse(ResponseEvent $event): void
    {
        $body = $event->getBody();
        if (!is_string($body) || !$event->getHeaders()->contains('Content-Type', 'text/html')) {
            return;
        }

        $timer = gettimeofday(true) - APP_STARTED;

        $stats = strtr(
            <<<STATS
            <!-- script {SRC_T} + sql({SQL_C}) {SQL_T} + tpl({TPL_C}) {TPL_T} = {ALL_T} -->
            STATS,
            [
                '{SRC_T}' => round($timer - instance(Db::class)->getTimer() - instance(Template::class)->getTimer(), 3),
                '{SQL_C}' => instance(Db::class)->getCounter(),
                '{SQL_T}' => round(instance(Db::class)->getTimer(), 3),
                '{TPL_C}' => instance(Template::class)->getCounter(),
                '{TPL_T}' => round(instance(Template::class)->getTimer(), 3),
                '{ALL_T}' => round($timer, 3),
            ],
        );

        $event->setBody($body . $stats);
    }
}
