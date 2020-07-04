<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace ShopsUniverse\Mercury\Product;

use ShopsUniverse\Mercury\Catalogue\Catalogable;
use ShopsUniverse\Mercury\Kernel\ComparableEntity;
use ShopsUniverse\Mercury\Kernel\Entity;
use ShopsUniverse\Mercury\Kernel\Code;
use ShopsUniverse\Mercury\Kernel\Locale;
use ShopsUniverse\Mercury\Kernel\RecordableEntityTrait;
use ShopsUniverse\Mercury\Kernel\Recordable;
use ShopsUniverse\Mercury\Kernel\Translatable;
use ShopsUniverse\Mercury\Kernel\TranslatableTrait;
use ShopsUniverse\Mercury\Product\Events\ProductRenamed;

class Product implements ProductInterface,
    Translatable,
    Recordable,
    ComparableEntity,
    Catalogable
{
    use TranslatableTrait, RecordableEntityTrait;

    private string $id;
    private Code $code;
    private Name $name;
    private Description $description;
    private MetaInfo $metaInfo;

    public function __construct(
        string $id,
        string $code,
        string $name,
        string $description,
        MetaInfo $metaInfo
    ) {
        $this->id = $id;
        $this->code = new Code($code);
        $this->name = new Name($name);
        $this->description = new Description($description);
        $this->metaInfo = $metaInfo;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(Locale $locale = null): Name
    {
        $translation = $this->findTranslation($locale, 'name');

        if ($translation) {
            /** @noinspection PhpUnhandledExceptionInspection */
            return new Name($translation);
        }

        return $this->name;
    }

    public function rename(string $name): void
    {
        $oldName = $this->name;

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->name = new Name($name);

        $this->record(new ProductRenamed($this, $oldName, $this->name));
    }

    public function getDescription(Locale $locale = null): Description
    {
        $translation = $this->findTranslation($locale, 'description');

        if ($translation) {
            /** @noinspection PhpUnhandledExceptionInspection */
            return new Description($translation);
        }

        return $this->description;
    }

    public function getCode(): Code
    {
        return $this->code;
    }

    public function getMetaInfo(): MetaInfo
    {
        return $this->metaInfo;
    }

    public function equals(Entity $entity): bool
    {
        return $this->code->__toString() === $entity->getCode()->__toString();
    }
}
