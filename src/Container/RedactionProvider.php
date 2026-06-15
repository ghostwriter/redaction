<?php

declare(strict_types=1);

namespace Ghostwriter\Redaction\Container;

use Ghostwriter\Container\Service\Provider\AbstractProvider;
use Ghostwriter\Redaction\Container\Factory\RulesFactory;
use Ghostwriter\Redaction\Interface\RedactorInterface;
use Ghostwriter\Redaction\Interface\RulesInterface;
use Ghostwriter\Redaction\Redactor;
use Ghostwriter\Redaction\Rules;

/**
 * @see RedactionProviderTest
 */
final class RedactionProvider extends AbstractProvider
{
    /**
     * alias => service.
     *
     * @var array<class-string,class-string>
     */
    public const array ALIAS = [
        RedactorInterface::class => Redactor::class,
        RulesInterface::class => Rules::class,
    ];

    /**
     * service => factory.
     *
     * @var array<class-string,class-string<FactoryInterface>>
     */
    public const array FACTORY = [
        Rules::class => RulesFactory::class,
    ];
}
