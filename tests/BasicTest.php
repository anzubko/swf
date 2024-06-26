<?php

use App\Shared\Dir;
use App\Shared\File;
use PHPUnit\Framework\TestCase;
use Twig\Environment as TwigEnvironment;
use Twig\Loader\FilesystemLoader as TwigFilesystemLoader;
use Twig\Source as TwigSource;

class BasicTest extends TestCase
{
    /**
     * Includes all classes.
     *
     * @throws Throwable
     */
    public function testClassesInclude(): void
    {
        $dir = APP_DIR . '/src';

        foreach (shared(Dir::class)->scan($dir, true, true) as $file) {
            if (!is_file($file) || !str_ends_with($file, '.php')) {
                continue;
            }

            $this->assertNotFalse(include_once $file);
        }
    }

    /**
     * Syntax checks at all native templates.
     *
     * @throws Throwable
     */
    public function testNativeTemplatesSyntax(): void
    {
        $dir = config('template')->get('native')['dir'];

        foreach (shared(Dir::class)->scan($dir, true, true) as $file) {
            if (!is_file($file) || !str_ends_with($file, '.php')) {
                continue;
            }

            exec(sprintf('php -l %s', $file), result_code: $code);

            $this->assertSame(0, $code);
        }
    }

    /**
     * Syntax checks at all twig templates.
     *
     * @throws Throwable
     */
    public function testTwigTemplatesSyntax(): void
    {
        $dir = config('template')->get('twig')['dir'];

        try {
            $loader = new TwigFilesystemLoader($dir);
        } catch (Throwable) {
            return;
        }

        $twig = new TwigEnvironment($loader);

        foreach (shared(Dir::class)->scan($dir, true, true) as $file) {
            if (!is_file($file) || !str_ends_with($file, '.twig')) {
                continue;
            }

            try {
                $twig->parse(
                    $twig->tokenize(
                        new TwigSource((string) shared(File::class)->get($file), basename($file), $file),
                    ),
                );
            } catch (Throwable $e) {
                $this->fail(sprintf('%s in %s:%d', $e->getMessage(), $e->getFile(), $e->getLine()));
            }

            $this->assertTrue(true);
        }
    }

    /**
     * Syntax checks at all xsl templates.
     *
     * @throws Throwable
     */
    public function testXslTemplatesSyntax(): void
    {
        if (!extension_loaded('libxml') || !extension_loaded('dom') || !extension_loaded('xsl')) {
            return;
        }

        $dir = config('template')->get('xslt')['dir'];

        foreach (shared(Dir::class)->scan($dir, true, true) as $file) {
            if (!is_file($file) || !str_ends_with($file, '.xsl')) {
                continue;
            }

            $doc = new DOMDocument();
            $this->assertNotFalse($doc->load($file, LIBXML_NOCDATA));

            $processor = new XSLTProcessor();
            $this->assertNotFalse($processor->importStylesheet($doc));
        }
    }
}
