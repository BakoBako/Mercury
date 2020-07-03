<?php

namespace ShopsUniverse\Mercury\Exception;

use Throwable;

class ArgumentNotBlankException extends \Exception
{
    public function __construct(string $argument)
    {
        parent::__construct(
            sprintf('Argument %s cannot be blank', $argument)
        );
    }
}
