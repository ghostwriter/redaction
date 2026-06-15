<?php

declare(strict_types=1);

namespace Tests\Unit;

use Ghostwriter\Redaction\Interface\RedactorInterface;
use Ghostwriter\Redaction\Redactor;
use PHPUnit\Framework\Attributes\CoversClass;
use Throwable;

use function is_a;

#[CoversClass(Redactor::class)]
final class RedactorTest extends AbstractTestCase
{
    /** @throws Throwable */
    public function testImplementsRedactionInterface(): void
    {
        self::assertTrue(is_a(Redactor::class, RedactorInterface::class, true));
    }
}
