<?php

namespace ShopsUniverse\Mercury\Kernel;

interface ComparableValueObject
{
    public function equals(ValueObject $valueObject): bool;
}
