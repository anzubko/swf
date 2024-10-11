<?php
declare(strict_types=1);

namespace App\Listener;

use App\Config\CommonConfig;
use App\Config\DbConfig;
use App\Config\TransactionConfig;
use App\Shared\Logger;
use App\Shared\Merger;
use App\Shared\Registry;
use App\Shared\Serializer;
use App\Shared\Text;
use SWF\Attribute\AsListener;
use SWF\Databaser;
use SWF\Event\BeforeCommandEvent;
use SWF\Event\BeforeControllerEvent;
use SWF\Event\HttpErrorEvent;
use SWF\Event\ResponseEvent;
use SWF\Event\TransactionRetryEvent;
use SWF\Interface\DatabaserInterface;
use SWF\Templater;
use function is_string;

class CommonListener
{
    #[AsListener(persistent: true)]
    public function mergeAssets(BeforeControllerEvent $event): void
    {
        i(Registry::class)->merged = i(Merger::class)->merge();
    }

    #[AsListener(persistent: true)]
    public function initDatabaser(BeforeControllerEvent | BeforeCommandEvent $event): void
    {
        Databaser::setDenormalizer(function (mixed $data, string $class): object {
            return i(Serializer::class)->denormalize($data, $class);
        });

        Databaser::setProfiler(function (DatabaserInterface $db, float $timer, array $queries): void {
            if (null === i(DbConfig::class)->slowQueryLog || $timer < i(DbConfig::class)->slowQueryMin) {
                return;
            }

            foreach ($queries as $i => $query) {
                $queries[$i] = i(Text::class)->fTrim($query);
            }

            $host = idn_to_utf8(i(Registry::class)->httpHost) . i(Registry::class)->requestUri;

            $message = sprintf("[%.2f] %s, %s\n\t%s\n", $timer, $db->getName(), $host, implode("\n\t", $queries));

            i(Logger::class)->customLog(i(DbConfig::class)->slowQueryLog, $message);
        });
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
    public function logTransactionRetry(TransactionRetryEvent $event): void
    {
        if (null === i(TransactionConfig::class)->retriesLog) {
            return;
        }

        $names = [];
        foreach ($event->getDeclarations() as $declaration) {
            $names[] = $declaration->getDb()->getName();
        }

        $host = idn_to_utf8(i(Registry::class)->httpHost) . i(Registry::class)->requestUri;

        $message = sprintf('%s [%d] %s, %s', $event->getException()->getState(), $event->getRetry(), implode(' + ', $names), $host);

        i(Logger::class)->customLog(i(TransactionConfig::class)->retriesLog, $message);
    }

    #[AsListener(persistent: true)]
    public function statsToHtmlResponse(ResponseEvent $event): void
    {
        if (!is_string($event->getBody()) || !$event->getHeaders()->contains('Content-Type', 'text/html')) {
            return;
        }

        $timer = gettimeofday(true) - i(Registry::class)->requestTime;

        $stats = strtr(
            <<<STATS
            <!-- script {SRC_T} + sql({SQL_C}) {SQL_T} + tpl({TPL_C}) {TPL_T} = {ALL_T} -->
            STATS,
            [
                '{SRC_T}' => round($timer - Databaser::getTimer() - Templater::getTimer(), 3),
                '{SQL_C}' => Databaser::getCounter(),
                '{SQL_T}' => round(Databaser::getTimer(), 3),
                '{TPL_C}' => Templater::getCounter(),
                '{TPL_T}' => round(Templater::getTimer(), 3),
                '{ALL_T}' => round($timer, 3),
            ],
        );

        $event->setBody($event->getBody() . $stats);
    }
}
