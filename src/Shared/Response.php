<?php declare(strict_types=1);

namespace App\Shared;

use App\Shared\Template\Native;
use App\Shared\Template\Twig;
use App\Shared\Template\Xslt;
use JsonException;
use LogicException;
use SWF\AbstractShared;
use SWF\Interface\TemplaterInterface;
use SWF\ResponseManager;
use SWF\Exception\TemplaterException;

class Response extends AbstractShared
{
    /**
     * Process and output native template.
     *
     * @param mixed[]|object|null $context
     *
     * @throws LogicException
     * @throws TemplaterException
     */
    public function native(
        string $filename,
        array|object|null $context = null,
        ?string $mime = null,
        int $code = 200,
        int $expire = 0,
        bool $exit = true,
    ): void {
        $this->transform($this->s(Native::class), $filename, $context, $mime, $code, $expire, $exit);
    }

    /**
     * Process and output twig template.
     *
     * @param mixed[]|object|null $context
     *
     * @throws LogicException
     * @throws TemplaterException
     */
    public function twig(
        string $filename,
        array|object|null $context = null,
        ?string $mime = null,
        int $code = 200,
        int $expire = 0,
        bool $exit = true,
    ): void {
        $this->transform($this->s(Twig::class), $filename, $context, $mime, $code, $expire, $exit);
    }

    /**
     * Process and output xslt template.
     *
     * @param mixed[]|object|null $context
     *
     * @throws LogicException
     * @throws TemplaterException
     */
    public function xslt(
        string $filename,
        array|object|null $context = null,
        ?string $mime = null,
        int $code = 200,
        int $expire = 0,
        bool $exit = true,
    ): void {
        $this->transform($this->s(Xslt::class), $filename, $context, $mime, $code, $expire, $exit);
    }

    /**
     * Process and output template.
     *
     * @param mixed[]|object|null $context
     *
     * @throws LogicException
     * @throws TemplaterException
     */
    public function template(
        string $filename,
        array|object|null $context = null,
        ?string $mime = null,
        int $code = 200,
        int $expire = 0,
        bool $exit = true,
    ): void {
        $this->transform($this->s(Template::class), $filename, $context, $mime, $code, $expire, $exit);
    }

    /**
     * Base method for template transformation.
     *
     * @param mixed[]|object|null $context
     *
     * @throws LogicException
     * @throws TemplaterException
     */
    protected function transform(
        TemplaterInterface $processor,
        string $filename,
        array|object|null $context,
        ?string $mime,
        int $code,
        int $expire,
        bool $exit = true,
    ): void {
        $contents = $processor->transform($filename, $context);

        $mime ??= $processor->getMime();
        if ('text/html' === $mime) {
            $contents .= $this->prepareStats($processor);
        }

        $this->inline($contents, $mime, $code, $expire, null, $exit);
    }

    private function prepareStats(TemplaterInterface $processor): string
    {
        $timer = gettimeofday(true) - APP_STARTED;

        return sprintf(
            '<!-- script %.3f + sql(%d) %.3f + tpl(%d) %.3f = %.3f -->',
            $timer - $this->s(Db::class)->getTimer() - $processor->getTimer(),
            $this->s(Db::class)->getCounter(),
            $this->s(Db::class)->getTimer(),
            $processor->getCounter(),
            $processor->getTimer(),
            $timer,
        );
    }

    /**
     * Output json as inline.
     *
     * @throws LogicException
     * @throws JsonException
     */
    public function json(
        mixed $contents,
        bool $pretty = false,
        int $code = 200,
        int $expire = 0,
        bool $exit = true,
    ): void {
        if ($pretty) {
            $contents = json_encode($contents, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } else {
            $contents = json_encode($contents, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
        }

        $this->output('inline', (string) $contents, 'application/json', $code, $expire, null, $exit);
    }

    /**
     * Output contents as inline.
     *
     * @throws LogicException
     */
    public function inline(
        string $contents,
        string $mime = 'text/plain',
        int $code = 200,
        int $expire = 0,
        ?string $filename = null,
        bool $exit = true,
    ): void {
        $this->output('inline', $contents, $mime, $code, $expire, $filename, $exit);
    }

    /**
     * Output contents as attachment.
     *
     * @throws LogicException
     */
    public function attachment(
        string $contents,
        string $mime = 'text/plain',
        int $code = 200,
        int $expire = 0,
        ?string $filename = null,
        bool $exit = true,
    ): void {
        $this->output('attachment', $contents, $mime, $code, $expire, $filename, $exit);
    }

    private function output(
        string $disposition,
        string $contents,
        string $mime = 'text/plain',
        int $code = 200,
        int $expire = 0,
        ?string $filename = null,
        bool $exit = true,
    ): void {
        ResponseManager::getInstance()->output(
            $disposition,
            $contents,
            $mime,
            $code,
            $expire,
            $filename,
            $this->s(Config::class)->compressMimes,
            $this->s(Config::class)->compressMin,
            $exit,
        );
    }

    /**
     * Redirect.
     *
     * @throws LogicException
     */
    public function redirect(string $uri, int $code = 302, bool $exit = true): void
    {
        ResponseManager::getInstance()->redirect($uri, $code, $exit);
    }

    /**
     * Shows error page.
     */
    public function error(int $code): never
    {
        ResponseManager::getInstance()->error($code);
    }
}
