<?php

namespace ShopsUniverse\Mercury\Product;

use ShopsUniverse\Mercury\Catalogue\Catalogable;
use ShopsUniverse\Mercury\Catalogue\Catalogue;
use ShopsUniverse\Mercury\Kernel\Code;

class ProductCatalogue implements Catalogue
{
    private array $items = [];
    private Code $code;
    private string $name;

    public function __construct(
        string $code,
        string $name
    ) {
        $this->code = new Code($code);
        $this->name = $name;
    }

    public function items(): array
    {
        return $this->items;
    }

    public function getCode(): Code
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function addItem(Catalogable $item): void
    {
        if ($this->hasItem($item)) {
            return;
        }

        $this->items[] = $item;
    }

    public function hasItem(Catalogable $itemToBeCompared): bool
    {
        return (bool)current(
            array_filter(
                $this->items, function ($existingItem) use ($itemToBeCompared) {
                return $existingItem == $itemToBeCompared;
            }
            )
        );
    }
}
