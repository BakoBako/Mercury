<?php

namespace ShopsUniverse\Mercury\Kernel;

interface ComparableEntity
{
    public function equals(Entity $entity): bool;
}
