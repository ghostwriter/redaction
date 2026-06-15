<?php

declare(strict_types=1);

namespace Ghostwriter\Redaction\Exception;

use Ghostwriter\Redaction\Interface\RedactionExceptionInterface;
use RuntimeException as PHPRuntimeException;

final class RuntimeException extends PHPRuntimeException implements RedactionExceptionInterface {}
