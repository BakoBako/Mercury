<?php

namespace ShopsUniverse\Mercury\Kernel;

use ShopsUniverse\Mercury\Exception\ArgumentNotBlankException;

class Code implements ValueObject
{
    private string $code;

    public function __construct(string $code)
    {
        if (empty($code)) {
            throw new ArgumentNotBlankException('$code');
        }

        $this->code = $code;
    }

    public function __toString(): string
    {
        return $this->code;
    }
}
