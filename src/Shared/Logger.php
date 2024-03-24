<?php declare(strict_types=1);

namespace App\Shared;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use SWF\AbstractShared;
use SWF\CommonLogger;
use Stringable;

class Logger extends AbstractShared implements LoggerInterface
{
    /**
     * @inheritDoc
     *
     * @param mixed[] $context
     * @param mixed[] $options
     */
    public function emergency(string|Stringable $message, array $context = [], array $options = []): void
    {
        $this->log(LogLevel::EMERGENCY, $message, $context, $options);
    }

    /**
     * @inheritDoc
     *
     * @param mixed[] $context
     * @param mixed[] $options
     */
    public function alert(string|Stringable $message, array $context = [], array $options = []): void
    {
        $this->log(LogLevel::ALERT, $message, $context, $options);
    }

    /**
     * @inheritDoc
     *
     * @param mixed[] $context
     * @param mixed[] $options
     */
    public function critical(string|Stringable $message, array $context = [], array $options = []): void
    {
        $this->log(LogLevel::CRITICAL, $message, $context, $options);
    }

    /**
     * @inheritDoc
     *
     * @param mixed[] $context
     * @param mixed[] $options
     */
    public function error(string|Stringable $message, array $context = [], array $options = []): void
    {
        $this->log(LogLevel::ERROR, $message, $context, $options);
    }

    /**
     * @inheritDoc
     *
     * @param mixed[] $context
     * @param mixed[] $options
     */
    public function warning(string|Stringable $message, array $context = [], array $options = []): void
    {
        $this->log(LogLevel::WARNING, $message, $context, $options);
    }

    /**
     * @inheritDoc
     *
     * @param mixed[] $context
     * @param mixed[] $options
     */
    public function notice(string|Stringable $message, array $context = [], array $options = []): void
    {
        $this->log(LogLevel::NOTICE, $message, $context, $options);
    }

    /**
     * @inheritDoc
     *
     * @param mixed[] $context
     * @param mixed[] $options
     */
    public function info(string|Stringable $message, array $context = [], array $options = []): void
    {
        $this->log(LogLevel::INFO, $message, $context, $options);
    }

    /**
     * @inheritDoc
     *
     * @param mixed[] $context
     * @param mixed[] $options
     */
    public function debug(string|Stringable $message, array $context = [], array $options = []): void
    {
        $this->log(LogLevel::DEBUG, $message, $context, $options);
    }

    /**
     * @inheritDoc
     *
     * @param mixed[] $context
     * @param mixed[] $options
     */
    public function log(mixed $level, string|Stringable $message, array $context = [], array $options = []): void
    {
        CommonLogger::getInstance()->log($level, $message, $context, $options);
    }

    /**
     * Logs database slow query.
     *
     * @param string[] $queries
     */
    public function dbSlowQuery(float $timer, array $queries): void
    {
        if (
            null === $this->s(Config::class)->dbSlowQueryLog
            || $timer <= $this->s(Config::class)->dbSlowQueryMin
        ) {
            return;
        }

        $host = idn_to_utf8($_SERVER['HTTP_HOST']) . $_SERVER['REQUEST_URI'];

        $queries = implode("\n\t", array_map(fn($a) => $this->s(Text::class)->fTrim($a), $queries));

        $message = sprintf("[%.2f] %s\n\t%s\n", $timer, $host, $queries);

        $this->info($message, options: [
            'destination' => $this->s(Config::class)->dbSlowQueryLog,
            'append_file_and_line' => false,
        ]);
    }

    /**
     * Logs transaction fails.
     */
    public function transactionFail(string $level, string $sqlState, int $retry): void
    {
        if (null === $this->s(Config::class)->transactionFailLog) {
            return;
        }

        $host = idn_to_utf8($_SERVER['HTTP_HOST']) . $_SERVER['REQUEST_URI'];

        $message = sprintf('[%s] [%d] %s', $sqlState, $retry, $host);

        $this->log($level, $message, options: [
            'destination' => $this->s(Config::class)->transactionFailLog,
            'append_file_and_line' => false,
        ]);
    }
}
