<?php

namespace Tests\Unit;

use Symfony\Component\Process\Process;
use Tests\TestCase;

use function base_path;

class CodeStyleLinterTest extends TestCase
{
    // Add more path to test
    protected const PATH_TO_TEST = [
        'app',
        'config',
        'public/index.php',
        'tests',
        'database'
    ];

    /** @test */
    public function psr2()
    {
        $phpCsFixerPath = base_path('vendor/bin/php-cs-fixer');
        // Let's check PSR-2 compliance for our code
        foreach (self::PATH_TO_TEST as $path) {
            $fullPath = base_path($path);
            // Run linter in dry-run mode so it changes nothing.
            $process = new Process([$phpCsFixerPath, 'fix', $fullPath, '--dry-run', '--allow-risky=no']);
            $process->run();
            // Exit code should be 0, else there is a problem with the PSR-2 compliance
            $this->assertEquals(
                0,
                $process->getExitCode(),
                $process->getOutput()
            );
        }
    }
}
