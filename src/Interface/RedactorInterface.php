<?php

declare(strict_types=1);

namespace Ghostwriter\Redaction\Interface;

interface RedactorInterface
{
    /** @throws RedactionExceptionInterface */
    public function redact(string $text): string;

    public function rules(): RulesInterface;
}
