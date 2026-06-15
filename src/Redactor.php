<?php

declare(strict_types=1);

namespace Ghostwriter\Redaction;

use Ghostwriter\Redaction\Exception\RuntimeException;
use Ghostwriter\Redaction\Exception\ShouldNotHappenException;
use Ghostwriter\Redaction\Interface\RedactionExceptionInterface;
use Ghostwriter\Redaction\Interface\RedactorInterface;
use Ghostwriter\Redaction\Interface\RuleInterface;
use Ghostwriter\Redaction\Interface\RulesInterface;
use Override;

use function is_string;
use function mb_trim;
use function preg_match;
use function preg_replace;

/**
 * @see RedactorTest
 */
final readonly class Redactor implements RedactorInterface
{
    public function __construct(
        private RulesInterface $rules
    ) {}

    /**
     * @param array<non-empty-string,non-empty-string> $rules
     *
     * @throws RedactionExceptionInterface
     */
    public static function new(array $rules = Rules::DEFAULT): self
    {
        return new self(Rules::new($rules));
    }

    /**
     * @param string $text
     *
     * @throws RedactionExceptionInterface
     *
     * @return non-empty-string
     */
    #[Override]
    public function redact(string $text): string
    {
        if (mb_trim($text) === '') {
            return $text;
        }

        foreach ($this->rules as $rule) {
            if (! $rule instanceof RuleInterface) {
                throw new ShouldNotHappenException('Invalid rule');
            }

            $regex = $rule->regex();

            if (! preg_match($regex, $text)) {
                continue;
            }

            $text = preg_replace($regex, $rule->replacement(), $text);
            if (! is_string($text)) {
                throw new RuntimeException('Failed to replace text');
            }
        }

        return $text;
    }

    public function rules(): RulesInterface
    {
        return $this->rules;
    }
}
