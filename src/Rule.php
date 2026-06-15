<?php

declare(strict_types=1);

namespace Ghostwriter\Redaction;

use Ghostwriter\Redaction\Exception\InvalidArgumentException;
use Ghostwriter\Redaction\Interface\RedactionExceptionInterface;
use Ghostwriter\Redaction\Interface\RuleInterface;

use function mb_trim;

final readonly class Rule implements RuleInterface
{
    /**
     * @param non-empty-string $regex
     * @param non-empty-string $replacement
     *
     * @throws RedactionExceptionInterface
     */
    public function __construct(
        private string $regex,
        private string $replacement
    ) {
        if (mb_trim($regex) === '') {
            throw new InvalidArgumentException('Regex cannot be empty');
        }

        if (mb_trim($replacement) === '') {
            throw new InvalidArgumentException('Replacement cannot be empty');
        }
    }

    /**
     * @param string $regex
     * @param string $replacement
     */
    public static function new(string $regex, string $replacement): self
    {
        return new self($regex, $replacement);
    }

    /** @return non-empty-string */
    public function regex(): string
    {
        return $this->regex;
    }

    /** @return non-empty-string */
    public function replacement(): string
    {
        return $this->replacement;
    }
}
