<?php

declare(strict_types=1);

namespace Ghostwriter\Redaction\Interface;

use IteratorAggregate;

/**
 * @extends IteratorAggregate<non-empty-string,RuleInterface>
 */
interface RulesInterface extends IteratorAggregate
{
    /** @throws RedactionExceptionInterface */
    public function add(RuleInterface $rule): void;

    /** @return array<non-empty-string,RuleInterface> */
    public function toArray(): array;
}
