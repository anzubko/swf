<?php declare(strict_types=1);

namespace App\Shared;

use JsonException;
use ReflectionException;
use SWF\Exception\TemplaterException;
use SWF\HeaderRegistry;
use SWF\ResponseManager;

class Response
{
    /**
     * Sends response as transformed template.
     *
     * @param mixed[]|null $data
     *
     * @throws TemplaterException
     * @throws ReflectionException
     */
    public function template(string $filename, ?array $data = null, int $code = 200, string $charset = 'UTF-8'): self
    {
        $body = i(Template::class)->transform($filename, $data);

        $type = i(Template::class)->getType();

        return $this->send($body, $code, $type, $charset);
    }

    /**
     * Sends response as json.
     *
     * @throws JsonException
     * @throws ReflectionException
     */
    public function json(mixed $body, bool $pretty = false): self
    {
        $body = json_encode($body, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | ($pretty ? JSON_PRETTY_PRINT : 0));

        return $this->send($body, 200, 'application/json', 'UTF-8');
    }

    /**
     * Sends response.
     *
     * @param string|resource $body
     *
     * @throws ReflectionException
     */
    public function send(mixed $body, int $code = 200, string $type = 'text/plain', ?string $charset = null): self
    {
        $this->headers()->setContentType($type, $charset);

        $this->headers()->setCacheControl(['private', 'max-age' => 0], false);

        i(ResponseManager::class)->send($body, $code);

        return $this;
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
    public function redirect(string $url, int $code = 302): self
    {
        i(ResponseManager::class)->redirect($url, $code);

        return $this;
    }

    /**
     * Just exit call.
     */
    public function exit(): never
    {
        exit(0);
    }
}
