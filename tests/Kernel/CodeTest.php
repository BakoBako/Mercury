<?php

namespace ShopsUniverse\Mercury\Tests\Kernel;

use ShopsUniverse\Mercury\Exception\ArgumentNotBlankException;
use ShopsUniverse\Mercury\Kernel\Code;
use ShopsUniverse\Mercury\Tests\ValueObjectCommonTests;

class CodeTest extends ValueObjectCommonTests
{
    protected string $class = Code::class;
    protected array $arguments = ['aCode'];
    protected string $toStringValue = 'aCode';

    /**
     * @test
     */
    public function shouldThrowExceptionIfCodeIsEmpty()
    {
        $this->expectException(ArgumentNotBlankException::class);
        $this->expectExceptionMessage('Argument $code cannot be blank');

        $valueObject = new Code('');
    }
}
