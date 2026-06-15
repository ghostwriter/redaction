<?php

declare(strict_types=1);

namespace Ghostwriter\Redaction;

use Generator;
use Ghostwriter\Redaction\Exception\InvalidArgumentException;
use Ghostwriter\Redaction\Interface\RedactionExceptionInterface;
use Ghostwriter\Redaction\Interface\RuleInterface;
use Ghostwriter\Redaction\Interface\RulesInterface;

use function array_key_exists;

final class Rules implements RulesInterface
{
    /** @var array<non-empty-string,non-empty-string> */
    public const array DEFAULT = [
        '#gho_[a-zA-Z0-9]+#iu' => '**gho_REDACTED**',
        '#ghs_[a-zA-Z0-9]+#iu' => '**ghs_REDACTED**',
        '#ghs_[0-9]+_[a-zA-Z0-9_-]+\._[a-zA-Z0-9_-]+\._[a-zA-Z0-9_-]+#iu' => '**ghs_REDACTED**',
        '#GITHUB_TOKEN=[a-zA-Z0-9]+#iu' => 'GITHUB_TOKEN=**REDACTED**',
        '#GITHUB_TOKEN [a-zA-Z0-9]+#iu' => 'GITHUB_TOKEN **REDACTED**',
    ];

    /** @var array<non-empty-string,RuleInterface> */
    private array $rules = [];

    /**
     * @param array<string,string> $rules
     *
     * @throws RedactionExceptionInterface
     */
    public static function new(array $rules = self::DEFAULT): self
    {
        $instance = new self();
        foreach ($rules as $regex => $replacement) {
            $instance->add(Rule::new($regex, $replacement));
        }

        return $instance;
    }

    /** @throws RedactionExceptionInterface */
    public function add(RuleInterface $rule): void
    {
        $regex = $rule->regex();

        if (array_key_exists($regex, $this->rules)) {
            throw new InvalidArgumentException('Rule already exists');
        }

        $this->rules[$regex] = $rule;
    }

    /** @return Generator<non-empty-string,RuleInterface> */
    public function getIterator(): Generator
    {
        yield from $this->rules;
    }

    /** @return array<non-empty-string,RuleInterface> */
    public function toArray(): array
    {
        return $this->rules;
    }
}
