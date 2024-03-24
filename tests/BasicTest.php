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
        $runner = new Runner();
        $s = (new ReflectionClass($runner))->getMethod('s');

        /** @var Dir $sDir */
        $sDir = $s->invoke($runner, Dir::class);

        foreach ($sDir->scan(APP_DIR . '/src', true, true) as $file) {
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
        $runner = new Runner();
        $s = (new ReflectionClass($runner))->getMethod('s');

        /** @var Dir $sDir */
        $sDir = $s->invoke($runner, Dir::class);

        /** @var Config $sConfig */
        $sConfig = $s->invoke($runner, Config::class);

        foreach ($sDir->scan($sConfig->templateNative['dir'], true, true) as $file) {
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
        $runner = new Runner();
        $s = (new ReflectionClass($runner))->getMethod('s');

        /** @var Dir $sDir */
        $sDir = $s->invoke($runner, Dir::class);

        /** @var File $sFile */
        $sFile = $s->invoke($runner, File::class);

        /** @var Config $sConfig */
        $sConfig = $s->invoke($runner, Config::class);

        try {
            $loader = new TwigFilesystemLoader($sConfig->templateTwig['dir']);
        } catch (Throwable) {
            return;
        }

        $twig = new TwigEnvironment($loader);
        foreach ($sDir->scan($sConfig->templateTwig['dir'], true, true) as $file) {
            if (!is_file($file) || !str_ends_with($file, '.twig')) {
                continue;
            }

            try {
                $twig->parse($twig->tokenize(new TwigSource($sFile->get($file), basename($file), $file)));
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
        $runner = new Runner();
        $s = (new ReflectionClass($runner))->getMethod('s');

        /** @var Dir $sDir */
        $sDir = $s->invoke($runner, Dir::class);

        /** @var Config $sConfig */
        $sConfig = $s->invoke($runner, Config::class);

        foreach ($sDir->scan($sConfig->templateXslt['dir'], true, true) as $file) {
            if (!is_file($file) || !str_ends_with($file, '.xsl')) {
                continue;
            }

            if (extension_loaded('libxml') && extension_loaded('dom') && extension_loaded('xsl')) {
                $doc = new DOMDocument();
                $success = $doc->load($file, LIBXML_NOCDATA);
                $this->assertNotFalse($success);
                if (false === $success) {
                    continue;
                }
                $success = (new XSLTProcessor())->importStylesheet($doc);
                $this->assertNotFalse($success);
            } else {
                $this->fail('For XSL tests your need extensions: LIBXML, DOM and XSL');
            }
        }
    }
}
