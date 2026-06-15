<?php

declare(strict_types=1);

namespace Ghostwriter\Redaction\Container\Factory;

use Ghostwriter\Container\Interface\ContainerInterface;
use Ghostwriter\Container\Interface\Service\FactoryInterface;
use Ghostwriter\Redaction\Interface\RulesInterface;
use Ghostwriter\Redaction\Rules;
use Override;
use Throwable;

/**
 * @see RulesFactoryTest
 *
 * @implements FactoryInterface<RulesInterface>
 */
final readonly class RulesFactory implements FactoryInterface
{
    /** @throws Throwable */
    #[Override]
    public function __invoke(ContainerInterface $container): RulesInterface
    {
        return Rules::new(Rules::DEFAULT);
    }
}
