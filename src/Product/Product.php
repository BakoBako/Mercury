<?php

namespace ShopsUniverse\Mercury\Product;

use ShopsUniverse\Mercury\Kernel\EntityCode;
use ShopsUniverse\Mercury\Kernel\RecordableTrait;
use ShopsUniverse\Mercury\Kernel\Recordable;
use ShopsUniverse\Mercury\Kernel\TranslatableInterface;
use ShopsUniverse\Mercury\Kernel\TranslatableTrait;
use ShopsUniverse\Mercury\Product\Events\ProductRenamed;

class Product implements ProductInterface, TranslatableInterface, Recordable
{
    use TranslatableTrait, RecordableTrait;

    private ProductName $name;

    public function __construct(string $name)
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        $this->name = new ProductName($name);
    }

    public function getName(): ProductName
    {
        return $this->name;
    }

    public function rename(string $name): void
    {
        $oldName = $this->name;

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->name = new ProductName($name);

        $this->eventStore->record(new ProductRenamed($this, $oldName, $this->name));
    }

    public function getDescription(): ProductDescription
    {
        // TODO: Implement getDescription() method.
    }

    public function getCode(): EntityCode
    {
        // TODO: Implement getCode() method.
    }
}
