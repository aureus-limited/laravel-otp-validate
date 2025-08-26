<?php
declare(strict_types=1);

namespace Ferdous\OtpValidator\Tests\Feature;

use Ferdous\OtpValidator\Services\OtpService;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class OTPTest extends TestCase
{
    private OtpService $otpService;

    public function setUp(): void
    {
        $this->otpService = new OtpService();
    }

    #[DataProvider('dataProviderForOtpGenerate')]
    public function testOtpGenerate($digit, $expected): void
    {
        $random = $this->otpService->otpGenerator($digit);
        $this->assertTrue(strlen((string)$random) == $expected);
    }

    /**
     * @return int[]
     */
    public static function dataProviderForOtpGenerate(): array
    {
        return [
            [10, 10],
            [100, 100],
            [0,0],
            [-1,0],
            // [null, 4], // The null will trigged a call to config() but this will fail
        ];
    }
}
