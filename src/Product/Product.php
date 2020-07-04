<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace ShopsUniverse\Mercury\Product;

use ShopsUniverse\Mercury\Kernel\ComparableEntity;
use ShopsUniverse\Mercury\Kernel\ContainsEvents;
use ShopsUniverse\Mercury\Kernel\Entity;
use ShopsUniverse\Mercury\Kernel\EntityCode;
use ShopsUniverse\Mercury\Kernel\Locale;
use ShopsUniverse\Mercury\Kernel\RecordableEntityTrait;
use ShopsUniverse\Mercury\Kernel\Recordable;
use ShopsUniverse\Mercury\Kernel\Translatable;
use ShopsUniverse\Mercury\Kernel\TranslatableTrait;
use ShopsUniverse\Mercury\Product\Events\ProductRenamed;

class Product implements ProductInterface,
    Translatable,
    Recordable,
    ContainsEvents,
    ComparableEntity
{
    use TranslatableTrait, RecordableEntityTrait;
    private string $id;
    private EntityCode $code;
    private ProductName $name;
    private ProductDescription $description;

    public function __construct(
        string $id,
        string $code,
        string $name,
        string $description
    ) {
        $this->id = $id;
        $this->code = new EntityCode($code);
        $this->name = new ProductName($name);
        $this->description = new ProductDescription($description);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(Locale $locale = null): ProductName
    {
        $translation = $this->findTranslation($locale, 'name');

        if ($translation) {
            /** @noinspection PhpUnhandledExceptionInspection */
            return new ProductName($translation);
        }

        return $this->name;
    }

    public function rename(string $name): void
    {
        $oldName = $this->name;

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->name = new ProductName($name);

        $this->record(new ProductRenamed($this, $oldName, $this->name));
    }

    public function getDescription(Locale $locale = null): ProductDescription
    {
        $translation = $this->findTranslation($locale, 'description');

        if ($translation) {
            /** @noinspection PhpUnhandledExceptionInspection */
            return new ProductDescription($translation);
        }

        return $this->description;
    }

    public function getCode(): EntityCode
    {
        return $this->code;
    }

    public function equals(Entity $entity): bool
    {
        return $this->code->__toString() === $entity->getCode()->__toString();
    }
}
