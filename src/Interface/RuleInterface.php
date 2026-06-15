<?php

declare(strict_types=1);

namespace Ghostwriter\Redaction\Interface;

interface RuleInterface
{
    /** @return non-empty-string */
    public function regex(): string;

    /** @return non-empty-string */
    public function replacement(): string;
}
