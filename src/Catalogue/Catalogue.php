<?php

namespace ShopsUniverse\Mercury\Catalogue;

use ShopsUniverse\Mercury\Kernel\Codify;

interface Catalogue extends Codify
{
    public function items(): array;

    public function getName(): string;

    public function addItem(Catalogable $item): void;
    public function hasItem(Catalogable $item): bool;
}
