<?php

namespace ShopsUniverse\Mercury\Kernel;

interface Entity
{
    public function getId(): string;
    public function getCode() : EntityCode;
}
