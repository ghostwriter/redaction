<?php

declare(strict_types=1);

namespace Tests\Unit\Container;

use Ghostwriter\Container\Interface\BuilderInterface;
use Ghostwriter\Container\Service\Provider\AbstractProvider;
use Ghostwriter\Redaction\Container\Factory\RulesFactory;
use Ghostwriter\Redaction\Container\RedactionProvider;
use Ghostwriter\Redaction\Interface\RedactorInterface;
use Ghostwriter\Redaction\Interface\RulesInterface;
use Ghostwriter\Redaction\Redactor;
use Ghostwriter\Redaction\Rules;
use PHPUnit\Framework\Attributes\CoversClass;
use Tests\Unit\AbstractTestCase;

use function is_a;

#[CoversClass(RedactionProvider::class)]
final class RedactionProviderTest extends AbstractTestCase
{
    public function testExtendsAbstractProvider(): void
    {
        self::assertTrue(is_a(RedactionProvider::class, AbstractProvider::class, true));
    }

    public function testRedactionProviderRegister(): void
    {
        $builder = $this->createMock(BuilderInterface::class);

        $builder->expects(self::exactly(2))
            ->method('alias')
            ->withParameterSetsInOrder(
                [RedactorInterface::class, Redactor::class],
                [RulesInterface::class, Rules::class]
            );

        $builder->expects(self::exactly(1))
            ->method('factory')
            ->withParameterSetsInOrder([Rules::class, RulesFactory::class])
            ->seal();

        (new RedactionProvider())->register($builder);
    }
}
