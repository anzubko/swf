<?php declare(strict_types=1);

namespace App\Listener;

use App\Config\CommonConfig;
use App\Config\DbConfig;
use App\Config\TransactionConfig;
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
        i(Registry::class)->merged = i(Merger::class)->merge();
    }

    #[AsListener(persistent: true)]
    public function customErrorDocument(HttpErrorEvent $event): void
    {
        if (null === i(CommonConfig::class)->errorDocument) {
            return;
        }

        $errorDocument = strtr(i(CommonConfig::class)->errorDocument, ['{CODE}' => (string) $event->getCode()]);
        if (is_file($errorDocument)) {
            include $errorDocument;
        }
    }

    #[AsListener(persistent: true)]
    public function logTransactionFail(TransactionFailEvent $event): void
    {
        if (null === i(TransactionConfig::class)->failLog) {
            return;
        }

        $host = idn_to_utf8(i(Registry::class)->httpHost) . i(Registry::class)->requestUri;

        $message = sprintf('[%s] [%d] %s', $event->getException()->getSqlState(), $event->getRetries(), $host);

        i(Logger::class)->customLog(i(TransactionConfig::class)->failLog, $message);
    }

    #[AsListener(persistent: true)]
    public function logDbSlowQuery(DbSlowQueryEvent $event): void
    {
        if (null === i(DbConfig::class)->slowQueryLog) {
            return;
        }

        $queries = [];
        foreach ($event->getQueries() as $query) {
            $queries[] = i(Text::class)->fTrim($query);
        }

        $host = idn_to_utf8(i(Registry::class)->httpHost) . i(Registry::class)->requestUri;

        $message = sprintf("[%.2f] %s\n\t%s\n", $event->getTimer(), $host, implode("\n\t", $queries));

        i(Logger::class)->customLog(i(DbConfig::class)->slowQueryLog, $message);
    }

    #[AsListener(persistent: true)]
    public function statsToHtmlResponse(ResponseEvent $event): void
    {
        $body = $event->getBody();
        if (!is_string($body) || !$event->getHeaders()->contains('Content-Type', 'text/html')) {
            return;
        }

        $timer = gettimeofday(true) - i(Registry::class)->requestTime;

        $stats = strtr(
            <<<STATS
            <!-- script {SRC_T} + sql({SQL_C}) {SQL_T} + tpl({TPL_C}) {TPL_T} = {ALL_T} -->
            STATS,
            [
                '{SRC_T}' => round($timer - i(Db::class)->getTimer() - i(Template::class)->getTimer(), 3),
                '{SQL_C}' => i(Db::class)->getCounter(),
                '{SQL_T}' => round(i(Db::class)->getTimer(), 3),
                '{TPL_C}' => i(Template::class)->getCounter(),
                '{TPL_T}' => round(i(Template::class)->getTimer(), 3),
                '{ALL_T}' => round($timer, 3),
            ],
        );

        $event->setBody($body . $stats);
    }
}
