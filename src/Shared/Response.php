<?php declare(strict_types=1);

namespace App\Shared;

use App\Shared\Template\Native;
use App\Shared\Template\Twig;
use App\Shared\Template\Xslt;
use JsonException;
use SWF\AbstractShared;
use SWF\Interface\TemplaterInterface;
use SWF\ResponseManager;
use SWF\Exception\TemplaterException;

class Response extends AbstractShared
{
    /**
     * Process and output native template.
     *
     * @param mixed[]|null $data
     *
     * @throws TemplaterException
     */
    public function native(
        string $filename,
        ?array $data = null,
        ?string $mime = null,
        int $code = 200,
        int $expire = 0,
        bool $exit = true,
    ): void {
        $this->transform(shared(Native::class), $filename, $data, $mime, $code, $expire, $exit);
    }

    /**
     * Process and output twig template.
     *
     * @param mixed[]|null $data
     *
     * @throws TemplaterException
     */
    public function twig(
        string $filename,
        ?array $data = null,
        ?string $mime = null,
        int $code = 200,
        int $expire = 0,
        bool $exit = true,
    ): void {
        $this->transform(shared(Twig::class), $filename, $data, $mime, $code, $expire, $exit);
    }

    /**
     * Process and output xslt template.
     *
     * @param mixed[]|null $data
     *
     * @throws TemplaterException
     */
    public function xslt(
        string $filename,
        ?array $data = null,
        ?string $mime = null,
        int $code = 200,
        int $expire = 0,
        bool $exit = true,
    ): void {
        $this->transform(shared(Xslt::class), $filename, $data, $mime, $code, $expire, $exit);
    }

    /**
     * Process and output template.
     *
     * @param mixed[]|null $data
     *
     * @throws TemplaterException
     */
    public function template(
        string $filename,
        ?array $data = null,
        ?string $mime = null,
        int $code = 200,
        int $expire = 0,
        bool $exit = true,
    ): void {
        $this->transform(shared(Template::class), $filename, $data, $mime, $code, $expire, $exit);
    }

    /**
     * Base method for template transformation.
     *
     * @param mixed[]|null $data
     *
     * @throws TemplaterException
     */
    private function transform(
        TemplaterInterface $processor,
        string $filename,
        ?array $data,
        ?string $mime,
        int $code,
        int $expire,
        bool $exit = true,
    ): void {
        $contents = $processor->transform($filename, $data);

        $mime ??= $processor->getMime();
        if ('text/html' === $mime) {
            $timer = gettimeofday(true) - APP_STARTED;

            $contents .= sprintf(
                '<!-- script %.3f + sql(%d) %.3f + tpl(%d) %.3f = %.3f -->',
                $timer - shared(Db::class)->getTimer() - $processor->getTimer(),
                shared(Db::class)->getCounter(),
                shared(Db::class)->getTimer(),
                $processor->getCounter(),
                $processor->getTimer(),
                $timer,
            );
        }

        $this->inline($contents, $mime, $code, $expire, null, $exit);
    }

    /**
     * Output json as inline.
     *
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

        $this->inline((string) $contents, 'application/json', $code, $expire, null, $exit);
    }

    /**
     * Output contents as inline.
     */
    public function inline(
        string $contents,
        string $mime = 'text/plain',
        int $code = 200,
        int $expire = 0,
        ?string $filename = null,
        bool $exit = true,
    ): void {
        ResponseManager::output(
            'inline',
            $contents,
            $mime,
            $code,
            $expire,
            $filename,
            config('common')->get('compressMimes'),
            config('common')->get('compressMin'),
            $exit,
        );
    }

    /**
     * Output contents as attachment.
     */
    public function attachment(
        string $contents,
        string $mime = 'text/plain',
        int $code = 200,
        int $expire = 0,
        ?string $filename = null,
        bool $exit = true,
    ): void {
        ResponseManager::output(
            'attachment',
            $contents,
            $mime,
            $code,
            $expire,
            $filename,
            config('common')->get('compressMimes'),
            config('common')->get('compressMin'),
            $exit,
        );
    }

    /**
     * Redirects to specified url.
     */
    public function redirect(string $uri, int $code = 302, bool $exit = true): void
    {
        ResponseManager::redirect($uri, $code, $exit);
    }

    /**
     * Shows error page.
     */
    public function error(int $code): never
    {
        ResponseManager::error($code);
    }
}
