<?php
declare(strict_types=1);

namespace App\Shared;

use Exception;
use JsonException;
use SWF\Exception\ExitSimulationException;
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
    public function template(string $filename, ?array $data = null, int $code = 200, string $charset = 'UTF-8'): static
    {
        $transformed = i(Template::class)->transform($filename, $data);

        return $this->send($transformed->body, $code, $transformed->type, $charset);
    }

    /**
     * Sends response as json.
     *
     * @throws JsonException
     * @throws Throwable
     */
    public function json(mixed $body, bool $pretty = false): static
    {
        $body = json_encode($body, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | ($pretty ? JSON_PRETTY_PRINT : 0));

        return $this->send($body, 200, 'application/json', 'UTF-8');
    }

    /**
     * Sends response.
     *
     * @param string|resource $body
     *
     * @throws Throwable
     */
    public function send(mixed $body, int $code = 200, string $type = 'text/plain', ?string $charset = null): static
    {
        $this->headers()->setContentType($type, $charset);

        $this->headers()->setCacheControl(['private', 'max-age' => 0], false);

        ResponseManager::send($body, $code);

        return $this;
    }

    /**
     * Returns headers registry.
     */
    public function headers(): HeaderRegistry
    {
        return ResponseManager::headers();
    }

    /**
     * Redirects to specified url.
     */
    public function redirect(string $url, int $code = 302): static
    {
        ResponseManager::redirect($url, $code);

        return $this;
    }

    /**
     * Shows error page through regular exception.
     *
     * @throws Exception
     */
    public function error(int $code = 500, string $message = ''): never
    {
        ResponseManager::error($code, $message);
    }

    /**
     * Exits from current controller through special exception.
     *
     * @throws ExitSimulationException
     */
    public function end(): never
    {
        ResponseManager::end();
    }
}
