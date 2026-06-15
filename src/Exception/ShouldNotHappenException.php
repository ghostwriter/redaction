<?php

declare(strict_types=1);

namespace Ghostwriter\Redaction\Exception;

use Ghostwriter\Redaction\Interface\RedactionExceptionInterface;
use LogicException;

final class ShouldNotHappenException extends LogicException implements RedactionExceptionInterface {}
