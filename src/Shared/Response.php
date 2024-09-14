<?php declare(strict_types=1);

namespace App\Shared;

use JsonException;
use SWF\Exception\TemplaterException;
use SWF\HeaderRegistry;
use SWF\ResponseManager;
use Throwable;

class Response
{
    /**
     * Sends response as transformed template.
     *
     * @param mixed[]|null $data
     *
     * @throws TemplaterException
     * @throws Throwable
     */
    public function template(string $filename, ?array $data = null, int $code = 200, string $charset = 'UTF-8', bool $exit = true): void
    {
        $body = i(Template::class)->transform($filename, $data);

        $type = i(Template::class)->getType();

        $this->send($body, $code, $type, $charset, $exit);
    }

    /**
     * Sends response as json.
     *
     * @throws JsonException
     * @throws Throwable
     */
    public function json(mixed $body, bool $pretty = false, bool $exit = true): void
    {
        $body = json_encode($body, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | ($pretty ? JSON_PRETTY_PRINT : 0));

        $this->send($body, 200, 'application/json', 'UTF-8', $exit);
    }

    /**
     * Sends response.
     *
     * @param string|resource $body
     *
     * @throws Throwable
     */
    public function send(mixed $body, int $code = 200, string $type = 'text/plain', ?string $charset = null, bool $exit = true): void
    {
        $this->headers()->setContentType($type, $charset);

        $this->headers()->setCacheControl(['private', 'max-age' => 0], false);

        i(ResponseManager::class)->send($body, $code, $exit);
    }

    /**
     * Returns headers registry.
     */
    public function headers(): HeaderRegistry
    {
        return i(ResponseManager::class)->headers();
    }

    /**
     * Redirects to specified url.
     */
    public function redirect(string $url, int $code = 302, bool $exit = true): void
    {
        i(ResponseManager::class)->redirect($url, $code, $exit);
    }

    /**
     * Shows error page and exit.
     */
    public function error(int $code): never
    {
        i(ResponseManager::class)->error($code);
    }
}
