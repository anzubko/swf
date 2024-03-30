<?php

use App\Runner;
use App\Shared\Config;
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
        $app = new Runner();
        $dir = APP_DIR . '/src';

        foreach ($app->s(Dir::class)->scan($dir, true, true) as $file) {
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
        $app = new Runner();
        $dir = $app->s(Config::class)->templateNative['dir'];

        foreach ($app->s(Dir::class)->scan($dir, true, true) as $file) {
            if (!is_file($file) || !str_ends_with($file, '.php')) {
                continue;
            }

            exec(sprintf('php -l %s', $file), result_code: $result);

            $this->assertSame(0, $result);
        }
    }

    /**
     * Syntax checks at all twig templates.
     *
     * @throws Throwable
     */
    public function testTwigTemplatesSyntax(): void
    {
        $app = new Runner();
        $dir = $app->s(Config::class)->templateTwig['dir'];

        try {
            $loader = new TwigFilesystemLoader($dir);
        } catch (Throwable) {
            return;
        }

        $twig = new TwigEnvironment($loader);
        foreach ($app->s(Dir::class)->scan($dir, true, true) as $file) {
            if (!is_file($file) || !str_ends_with($file, '.twig')) {
                continue;
            }

            try {
                $twig->parse(
                    $twig->tokenize(
                        new TwigSource($app->s(File::class)->get($file), basename($file), $file),
                    ),
                );
                $this->assertTrue(true);
            } catch (Throwable $e) {
                $this->fail(sprintf('%s in %s:%d', $e->getMessage(), $e->getFile(), $e->getLine()));
            }
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

        $app = new Runner();
        $dir = $app->s(Config::class)->templateXslt['dir'];

        foreach ($app->s(Dir::class)->scan($dir, true, true) as $file) {
            if (!is_file($file) || !str_ends_with($file, '.xsl')) {
                continue;
            }

            $doc = new DOMDocument();
            $this->assertNotFalse(
                $doc->load($file, LIBXML_NOCDATA)
            );
            $processor = new XSLTProcessor();
            $this->assertNotFalse(
                $processor->importStylesheet($doc)
            );
        }
    }
}
