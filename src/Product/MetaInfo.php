<?php

namespace ShopsUniverse\Mercury\Product;

use ShopsUniverse\Mercury\Kernel\ValueObject;

class MetaInfo implements ValueObject
{
    private string $title;
    private string $keywords;
    private string $description;

    public function __construct(string $title, string $keywords, string $description)
    {
        $this->title = $title;
        $this->keywords = $keywords;
        $this->description = $description;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getKeywords(): string
    {
        return $this->keywords;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function __toString(): string
    {
        return $this->title;
    }
}
