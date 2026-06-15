<?php

declare(strict_types=1);

namespace Ghostwriter\Redaction\Exception;

use Ghostwriter\Redaction\Interface\RedactionExceptionInterface;
use InvalidArgumentException as PHPInvalidArgumentException;

final class InvalidArgumentException extends PHPInvalidArgumentException implements RedactionExceptionInterface {}
