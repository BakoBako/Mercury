<?php

namespace ShopsUniverse\Mercury\Kernel;

interface Entity extends Codify
{
    public function getId(): string;
}
