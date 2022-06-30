<?php

namespace Src\ReadingsDetector\Client\Domain\ValueObject;

final class ClientName
{
    public function __construct(private string $name){ }

    public function value() : string
    {
        return $this->name;
    }

}
